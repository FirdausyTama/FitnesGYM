<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FitnesGYM | Pushing Limits</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logogym.png') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">Fitnes<span>GYM</span></div>

        <!-- Mobile Menu Toggle -->
        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
        </label>

        <div class="nav-links">
            <a href="#home">Beranda</a>
            <a href="#programs">Program</a>
            <a href="#pricing">Harga</a>
            <a href="#contact">Kontak</a>
            <div class="nav-auth">
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1 class="animate-fade">PUSH YOUR <span>LIMITS</span></h1>
            <p class="animate-fade" style="animation-delay: 0.2s;">Transformasi tubuh dan pikiran Anda dengan pelatih
                profesional dan fasilitas terbaik di kota ini.</p>
            <div class="cta-group animate-fade" style="animation-delay: 0.4s;">
                <a href="#pricing" class="btn-primary">Daftar Sekarang</a>
                <a href="#programs" class="btn-secondary">Lihat Program</a>
            </div>
        </div>
    </section>

    <!-- Running Text Strip -->
    <div class="marquee-strip">
        <div class="marquee-content">
            <span>AEROBIK & FITNESS // BUKA SETIAP HARI // NO PAIN NO GAIN // JOIN FitnesGYM // HARGA MAHASISWA //
                AEROBIK & FITNESS // BUKA SETIAP HARI // NO PAIN NO GAIN // JOIN FitnesGYM // HARGA MAHASISWA //</span>
            <span>AEROBIK & FITNESS // BUKA SETIAP HARI // NO PAIN NO GAIN // JOIN FitnesGYM // HARGA MAHASISWA //
                AEROBIK & FITNESS // BUKA SETIAP HARI // NO PAIN NO GAIN // JOIN FitnesGYM // HARGA MAHASISWA //</span>
        </div>
    </div>

    <!-- Programs Section -->
    <section class="section-padding" id="programs">
        <div class="section-title animate-fade">
            <h2>Program Kami</h2>
            <div class="line"></div>
        </div>
        <div class="programs-grid">
            <div class="program-card animate-fade">
                <img src="{{ asset('images/bodybuilding.png') }}" alt="Bodybuilding">
                <div class="program-overlay">
                    <h3>Pembentukan Otot</h3>
                    <p>Bangun massa otot dan kekuatan dengan program latihan beban khusus kami.</p>
                </div>
            </div>
            <div class="program-card animate-fade" style="animation-delay: 0.2s;">
                <img src="{{ asset('images/yoga.png') }}" alt="Yoga">
                <div class="program-overlay">
                    <h3>Yoga & Kelenturan</h3>
                    <p>Tingkatkan kelenturan dan temukan ketenangan batin dengan sesi yoga ahli kami.</p>
                </div>
            </div>
            <div class="program-card animate-fade" style="animation-delay: 0.4s;">
                <img src="{{ asset('images/cardio.png') }}" alt="Cardio">
                <div class="program-overlay">
                    <h3>Cardio Intensif</h3>
                    <p>Tingkatkan stamina dan bakar kalori dengan latihan kardio intensitas tinggi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="section-padding" id="pricing">
        <div class="section-title animate-fade">
            <h2>Pilihan Paket Kami</h2>
            <div class="line"></div>
        </div>

        <!-- Section 1: Paket Harian -->
        <div class="section-title animate-fade" style="margin-bottom: 2rem;">
            <h3 style="font-size: 1.5rem; text-transform: uppercase;">Paket Harian</h3>
        </div>
        <div class="pricing-grid"
            style="margin-bottom: 5rem; justify-content: center; grid-template-columns: repeat(auto-fit, minmax(280px, 350px));">
            <!-- Harian Non-Member -->
            <div class="price-card animate-fade">
                <h3>Non-Member</h3>
                <div class="price"><span>Rp</span>25k<span>/hari</span></div>
                <ul>
                    <li>Akses Gym Seharian</li>
                    <li>Tanpa Komitmen Member</li>
                    <li>Loker & Kamar Mandi</li>
                    <li>Tanpa Biaya Registrasi</li>
                </ul>
                <a href="#" class="btn-secondary">Langsung Datang</a>
            </div>

            <!-- Harian Member -->
            <div class="price-card animate-fade" style="animation-delay: 0.1s; border: 1px solid var(--primary-glow);">
                <h3>Harian Member</h3>
                <div class="price"><span>Rp</span>15k<span>/hari</span></div>
                <div class="reg-fee"
                    style="margin-top: -10px; margin-bottom: 15px; font-size: 0.85rem; color: var(--primary);">+ Biaya
                    Registrasi 25rb</div>
                <ul>
                    <li>Akses Gym Lebih Hemat</li>
                    <li>Berlaku untuk Member</li>
                    <li>Loker & Kamar Mandi</li>
                    <li>QR Member Digital</li>
                </ul>
                <a href="#" class="btn-primary">Daftar Member</a>
            </div>
        </div>

        <!-- Section 2: Membership Packages -->
        <div class="section-title animate-fade" style="margin-bottom: 2rem;">
            <h3 style="font-size: 1.5rem; text-transform: uppercase;">Paket Membership</h3>
        </div>
        <div class="pricing-grid"
            style="margin-bottom: 5rem; justify-content: center; grid-template-columns: repeat(auto-fit, minmax(280px, 350px));">
            <!-- Paket Bulanan -->
            <div class="price-card animate-fade">
                <h3>1 Bulan</h3>
                <div class="price"><span>Rp</span>150k<span>/bln</span></div>
                <ul>
                    <li>Akses Gym 24/7</li>
                    <li>QR Member Digital</li>
                    <li>Loker & Kamar Mandi</li>
                    <li>Belum Termasuk Registrasi</li>
                </ul>
                <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20tertarik%20dengan%20paket%20Membership%201%20Bulan" target="_blank" class="btn-secondary">Pilih Paket</a>
            </div>

            <!-- Paket Pro (3 Bln) -->
            <div class="price-card featured animate-fade" style="animation-delay: 0.1s; position: relative;">
                <div class="badge-deal"
                    style="position: absolute; top: 0; right: 0; background: #ffbd03; color: #000; padding: 6px 15px; border-radius: 0 15px 0 15px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                    Best Deal</div>
                <h3>3 Bulan</h3>
                <div class="price"><span>Rp</span>400k<span>/3 bln</span></div>
                <ul>
                    <li>Akses Gym 24/7</li>
                    <li>QR Member Digital</li>
                    <li>Loker & Kamar Mandi</li>
                    <li>Termasuk Biaya Registrasi</li>
                </ul>
                <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20tertarik%20dengan%20paket%20Membership%203%20Bulan" target="_blank" class="btn-primary">Pilih Paket</a>
            </div>

            <!-- Paket Ultimate (6 Bln) -->
            <div class="price-card animate-fade" style="animation-delay: 0.2s;">
                <h3>6 Bulan</h3>
                <div class="price"><span>Rp</span>750k<span>/6 bln</span></div>
                <ul>
                    <li>Akses Gym 24/7</li>
                    <li>QR Member Digital</li>
                    <li>Loker & Kamar Mandi</li>
                    <li>Termasuk Biaya Registrasi</li>
                </ul>
                <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20tertarik%20dengan%20paket%20Membership%206%20Bulan" target="_blank" class="btn-secondary">Pilih Paket</a>
            </div>
        </div>

        <!-- Section 3: Personal Trainer -->
        <div class="section-title animate-fade" style="margin-bottom: 2rem;">
            <h3 style="font-size: 1.5rem; text-transform: uppercase;">Personal Trainer</h3>
        </div>
        <div class="pricing-grid"
            style="justify-content: center; grid-template-columns: repeat(auto-fit, minmax(280px, 350px));">
            <!-- PT 5x -->
            <div class="price-card animate-fade">
                <h3>5x Pertemuan</h3>
                <div class="price"><span>Rp</span>1jt</div>
                <ul>
                    <li>Privat Coaching Ahli</li>
                    <li>Sudah Termasuk Member</li>
                    <li>Sudah Termasuk Registrasi</li>
                    <li>Rencana Latihan Custom</li>
                </ul>
                <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20tertarik%20dengan%20paket%20Personal%20Trainer%205x%20Pertemuan" target="_blank" class="btn-secondary">Hubungi Coach</a>
            </div>

            <!-- PT 7x -->
            <div class="price-card animate-fade" style="animation-delay: 0.1s; border: 1px solid var(--primary-glow);">
                <h3>7x Pertemuan</h3>
                <div class="price"><span>Rp</span>1.5jt</div>
                <ul>
                    <li>Privat Coaching Ahli</li>
                    <li>Sudah Termasuk Member</li>
                    <li>Sudah Termasuk Registrasi</li>
                    <li>Rencana Latihan Custom</li>
                </ul>
                <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20tertarik%20dengan%20paket%20Personal%20Trainer%207x%20Pertemuan" target="_blank" class="btn-secondary">Hubungi Coach</a>
            </div>

            <!-- PT 13x -->
            <div class="price-card animate-fade" style="animation-delay: 0.2s;">
                <h3>13x Pertemuan</h3>
                <div class="price"><span>Rp</span>2jt</div>
                <ul>
                    <li>Privat Coaching Ahli</li>
                    <li>Sudah Termasuk Member</li>
                    <li>Sudah Termasuk Registrasi</li>
                    <li>Rencana Latihan Custom</li>
                </ul>
                <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20tertarik%20dengan%20paket%20Personal%20Trainer%2013x%20Pertemuan" target="_blank" class="btn-secondary">Hubungi Coach</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section-padding" id="contact">
        <div class="section-title animate-fade">
            <h2>Hubungi Kami</h2>
            <div class="line"></div>
        </div>
        <div class="contact-container animate-fade">
            <div class="contact-info">
                <div class="info-card">
                    <div class="info-icon">🕒</div>
                    <div class="info-text">
                        <h3>Jam Operasional</h3>
                        <p>Senin - Jumat: 07.00 - 21.00</p>
                        <p>Sabtu - Minggu: 09.00 - 21.00</p>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon">📞</div>
                    <div class="info-text">
                        <h3>Telepon</h3>
                        <p>+62 812-3456-7890</p>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon">📍</div>
                    <div class="info-text">
                        <h3>Alamat</h3>
                        <p>Jl. Monjali No.111, RW.2, Karanggeneng, Sendangadi, Kec. Mlati, Kabupaten Sleman, Daerah
                            Istimewa Yogyakarta 55285</p>
                    </div>
                </div>
            </div>
            <div class="contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63245.970855558626!2d110.33364504395989!3d-7.803248457450711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5787bd5b6bc5%3A0x21723fd4d3684f71!2sYogyakarta%2C%20Yogyakarta%20City%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1777304340959!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0; border-radius: 15px; min-height: 350px;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Testimonials Carousel -->
        <div class="testimonials-section animate-fade" style="margin-top: 5rem;">
            <div class="section-title">
                <h3 style="font-size: 1.5rem; text-transform: uppercase;">Apa Kata Mereka?</h3>
            </div>
            <div class="testimonial-slider">
                <div class="testimonial-track">
                    <!-- Original Cards -->
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span>
                        </div>
                        <p>"Tempatnya bersih dan alat-alatnya sangat lengkap. Coach-nya juga sangat ramah!"</p>
                        <h4>- Andi Pratama</h4>
                    </div>
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-empty">★</span>
                        </div>
                        <p>"Harga member sangat terjangkau untuk fasilitas sekelas ini. Best deal banget!"</p>
                        <h4>- Budi Santoso</h4>
                    </div>
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span>
                        </div>
                        <p>"Sangat nyaman latihan di sini. QR Member-nya juga bikin proses masuk jadi cepat."</p>
                        <h4>- Citra Lestari</h4>
                    </div>
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span>
                        </div>
                        <p>"PT-nya sangat profesional dan benar-benar membimbing sampai target tercapai."</p>
                        <h4>- Dedi Kurniawan</h4>
                    </div>
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-empty">★</span>
                        </div>
                        <p>"Lokasi strategis dan parkir luas. Latihan jadi makin semangat setiap hari!"</p>
                        <h4>- Eka Putri</h4>
                    </div>
                    <!-- Cloned Cards for Infinite Effect -->
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span>
                        </div>
                        <p>"Tempatnya bersih dan alat-alatnya sangat lengkap. Coach-nya juga sangat ramah!"</p>
                        <h4>- Andi Pratama</h4>
                    </div>
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-empty">★</span>
                        </div>
                        <p>"Harga member sangat terjangkau untuk fasilitas sekelas ini. Best deal banget!"</p>
                        <h4>- Budi Santoso</h4>
                    </div>
                    <div class="testimonial-card">
                        <div class="stars">
                            <span class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span><span class="star-fill">★</span><span
                                class="star-fill">★</span>
                        </div>
                        <p>"Sangat nyaman latihan di sini. QR Member-nya juga bikin proses masuk jadi cepat."</p>
                        <h4>- Citra Lestari</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="logo">Fitnes<span>GYM</span></div>
            <div class="social-links">
                <a href="#">FB</a>
                <a href="#">IG</a>
                <a href="#">TW</a>
            </div>
        </div>
        <div class="copyright">
            &copy; {{ date('Y') }} FitnesGYM. Seluruh hak cipta dilindungi. Dirancang untuk keunggulan.
        </div>
    </footer>

    <script>
        // Smooth scrolling and mobile menu close
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                // Close mobile menu if open
                const navToggle = document.getElementById('nav-toggle');
                if (navToggle) navToggle.checked = false;

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Simple fade-in observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate-fade').forEach(el => observer.observe(el));
    </script>
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6282119454211?text=Hallo%20Fitnes%20GYM,%20saya%20ingin%20bertanya..." target="_blank" class="whatsapp-float" aria-label="Chat with us on WhatsApp">
        <svg viewBox="0 0 32 32" fill="currentColor">
            <path d="M16 2a13 13 0 00-11 19.8L3 29l7.3-1.9A13 13 0 1016 2zm0 24a11 11 0 01-5.7-1.6l-.4-.2-4.3 1.1 1.1-4.2-.3-.4A11 11 0 1116 26zm6.1-8.3c-.3-.2-1.9-1-2.2-1.1-.3-.1-.5-.1-.7.2-.2.3-.8 1-.9 1.2-.1.2-.3.2-.6.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.7-1.6-2-.2-.3 0-.5.1-.6.1-.1.3-.4.4-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5s-.7-1.8-.9-2.3c-.3-.6-.5-.5-.7-.5h-.7c-.2 0-.6.1-.9.4s-1.1 1.1-1.1 2.6 1.1 3 1.2 3.2c.2.2 2.1 3.2 5.2 4.5.7.3 1.3.5 1.7.7.7.2 1.4.2 2 .1.6-.1 1.9-.8 2.2-1.5.3-.7.3-1.3.2-1.4-.1-.1-.3-.2-.6-.3z" />
        </svg>
    </a>
</body>

</html>