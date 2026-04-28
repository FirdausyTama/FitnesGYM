<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Package;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->get();
        $packages = Package::all();
        $nextId = $this->generateMemberId();
        return view('admin.members.index', compact('members', 'packages', 'nextId'));
    }

    public function store(Request $request)
    {
        $nextId = $this->generateMemberId();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'package_name' => 'required|string',
            'active_at' => 'required|date',
            'duration_months' => 'required|integer|min:0',
        ]);

        $activeAt = \Carbon\Carbon::parse($data['active_at']);
        $expiredAt = $activeAt->copy()->addMonths((int)$data['duration_months']);

        User::create([
            'name' => $data['name'],
            'username' => $nextId, // Username default sesuai ID
            'email' => $data['email'],
            'password' => Hash::make('fitnesgym' . $nextId), // Password default fitnesgym + ID
            'role' => 'member',
            'member_id' => $nextId,
            'package_name' => $data['package_name'],
            'active_at' => $activeAt,
            'expired_at' => $expiredAt,
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil ditambahkan! Username: ' . $nextId . ', Password: fitnesgym' . $nextId);
    }

    public function show(User $member)
    {
        return response()->json($member);
    }

    public function update(Request $request, User $member)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $member->id,
            'package_name' => 'required|string',
            'active_at' => 'required|date',
            'expired_at' => 'required|date',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Data member berhasil diupdate!');
    }

    private function generateMemberId()
    {
        $lastMember = User::where('role', 'member')->orderBy('id', 'desc')->first();
        if (!$lastMember || !$lastMember->member_id) {
            return '0001';
        }

        $lastNumber = (int) $lastMember->member_id;
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return $newNumber;
    }

    public function faceScanPage()
    {
        $members = User::where('role', 'member')->whereNotNull('face_descriptor')->get(['id', 'name', 'member_id', 'face_descriptor', 'expired_at', 'face_image']);
        $todayAttendances = Attendance::with('user')
            ->whereDate('created_at', now()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.face-scan', compact('members', 'todayAttendances'));
    }

    public function verifyFace(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($data['user_id']);
        
        if ($user->expired_at < now()) {
            return response()->json([
                'success' => false, 
                'message' => 'Akses Ditolak! Paket ' . $user->name . ' sudah kadaluarsa.',
                'user' => $user
            ]);
        }

        // Cek apakah sudah check-in hari ini dan belum check-out
        $activeAttendance = Attendance::where('user_id', $user->id)
            ->whereDate('created_at', now()->toDateString())
            ->whereNull('check_out_at')
            ->first();

        if ($activeAttendance) {
            return response()->json([
                'success' => false,
                'message' => 'Akses Ditolak! Anda sudah Check-in. Silakan Check-out terlebih dahulu.',
                'user' => $user
            ]);
        }

        // Simpan Absensi
        Attendance::create(['user_id' => $user->id]);

        return response()->json([
            'success' => true, 
            'message' => 'Selamat Datang, ' . $user->name . '!',
            'user' => $user
        ]);
    }

    public function updateFace(Request $request, User $member)
    {
        $data = $request->validate([
            'face_descriptor' => 'required|string',
            'face_image' => 'nullable|string',
        ]);

        $member->update([
            'face_descriptor' => $data['face_descriptor'],
            'face_image' => $data['face_image'] ?? $member->face_image
        ]);

        return response()->json(['success' => true, 'message' => 'Wajah berhasil didaftarkan!']);
    }

    public function destroy(User $member)
    {
        if ($member->role === 'member') {
            $member->delete();
            return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus!');
        }
        return back()->with('error', 'Tidak dapat menghapus admin.');
    }

    public function checkOut(Attendance $attendance)
    {
        $attendance->update(['check_out_at' => now()]);
        return back()->with('success', 'Member berhasil Check-out!');
    }

    public function clearAttendance()
    {
        Attendance::whereDate('created_at', now()->toDateString())->delete();
        return back()->with('success', 'History hari ini berhasil dibersihkan!');
    }
}
