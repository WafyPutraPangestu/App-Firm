<x-layout>
    <style>
        .parallax-element {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .parallax-element.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        .hover-card-effect {
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            will-change: transform;
        }
        .hover-card-effect:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            z-index: 10;
        }
        .icon-animate {
            opacity: 0;
            transform: scale(0.5) rotate(-15deg);
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .icon-animate.show-icon {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
        .bg-parallax-layer {
            will-change: transform;
            transform: scale(1.2); 
            height: 130%; 
            top: 0;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
    <div id="home" class="parallax-element bg-red-900 text-white grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-8">
        <div class="flex justify-center items-center px-4 sm:px-6 md:px-8 lg:px-12 py-8 lg:py-0">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-center lg:text-left">
                Kami adalah <strong class="text-yellow-100">pilihan yang terbaik</strong> untuk menyelesaikan setiap permasalahan hukum anda.
            </h1>
        </div>
        <div class="w-full">
            <img src="{{ Vite::asset('resources/asset/home/bg1.png') }}" alt="background" class="w-full h-full object-cover rounded-tl-none lg:rounded-tl-[60px]">
        </div>
    </div>
    <div class="bg-white py-8 sm:py-12 md:py-15"></div>
    <div class="relative w-full overflow-hidden min-h-[500px]"> 
        <div class="absolute inset-0 w-full h-full -z-10 overflow-hidden">
            <div class="bg-black/80 w-full h-full relative">
                <img src="{{ Vite::asset('resources/asset/home/bg1.png') }}" alt="background"
                    class="bg-parallax-layer absolute left-0 w-full object-cover opacity-30">
            </div>
        </div>
        <div id="about" class="parallax-element relative z-10 px-4 sm:px-6 md:px-12 lg:px-20 py-12 sm:py-16 md:py-20 text-white">
            <div class="rounded-lg p-4 sm:p-6 md:p-8 lg:p-12 space-y-4 sm:space-y-6">
                <p class="text-justify text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed">
                    ATS LAW FIRM pertama kali berdiri pada tanggal 27 Oktober 2015 di Jakarta dengan nama Ahmad,
                    Tangkudung, Sismoyo & Associate yang di prakarsai oleh Ahmad Muzayin, Arisaka W. Tangkudung dan Hendro Sismoyo.
                    Pada tanggal 18 Mei 2018 membubarkan diri karena salah satu pendiri menjadi hakim serta tingginya
                    aktivitas dan kesibukan tiap partner, sesuai dengan Akta Pembubaran Firma Hukum "Ahmad, Tangkudung, Sismoyo &
                    Associate".
                </p>
                <p class="text-justify text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed">
                    Kemudian pada tanggal 6 Mei 2020, Ahmad Muzayin dan Abdul Khalim kembali mendirikan firma hukum
                    dengan nama Attorney, Trusted & Solution (ATS LAW FIRM). Berbagai kasus penting baik kasus perdata maupun pidana
                    skala nasional telah ditanganinya dengan berbekal profesionalisme, etos kerja serta jaringan yang kuat dan
                    luas.
                </p>
                <p class="text-justify text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed">
                    ATS LAW FIRM hingga saat ini telah memberikan pelayanan hukum untuk perorangan maupun perusahaan,
                    kami menyediakan konsultan hukum yang berkualitas dan professional dalam melayani setiap kebutuhan klien
                    untuk mencegah permasalahan hukum yang akan timbul dan/atau yang sedang kami tangani dengan menyediakan
                    produk hukum yang berkualitas dengan harga yang kompetitif.
                </p>
                <p class="text-center text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed">
                    Dalam waktu yang singkat kami <strong class="text-yellow-600">berinovasi dan
                        berkomitmen</strong> sehingga mendapatkan reputasi yang baik.
                </p>
                <h1 class="text-yellow-600 text-center text-2xl sm:text-3xl md:text-4xl leading-relaxed font-extrabold mt-8">
                    Kenapa Memilih Kami
                </h1>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-b from-black/80 to-white px-4 sm:px-6 md:px-12 lg:px-20 pt-8 pb-12 sm:pb-16 md:pb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="parallax-element hover-card-effect bg-white text-black shadow-2xl rounded-lg px-4 sm:px-6 py-6 sm:py-8">
                <img src="{{ Vite::asset('resources/asset/icon/businessman.png') }}" alt=""
                    class="icon-animate mx-auto mt-2 mb-4 sm:mb-6 h-16 sm:h-20">
                <h1 class="text-center text-lg sm:text-xl font-bold mb-3 sm:mb-4">Profesional</h1>
                <p class="text-justify text-xs sm:text-sm leading-relaxed">
                    Kami memiliki konsultan hukum dengan keterampilan, pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white text-black shadow-2xl rounded-lg px-4 sm:px-6 py-6 sm:py-8" style="transition-delay: 100ms;">
                <img src="{{ Vite::asset('resources/asset/icon/time-management.png') }}" alt=""
                    class="icon-animate mx-auto mt-2 mb-4 sm:mb-6 h-16 sm:h-20">
                <h1 class="text-center text-lg sm:text-xl font-bold mb-3 sm:mb-4">Berdedikasi</h1>
                <p class="text-justify text-xs sm:text-sm leading-relaxed">
                    Kami memiliki konsultan hukum dengan keterampilan, pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white text-black shadow-2xl rounded-lg px-4 sm:px-6 py-6 sm:py-8" style="transition-delay: 200ms;">
                <img src="{{ Vite::asset('resources/asset/icon/discipline.png') }}" alt=""
                    class="icon-animate mx-auto mt-2 mb-4 sm:mb-6 h-16 sm:h-20">
                <h1 class="text-center text-lg sm:text-xl font-bold mb-3 sm:mb-4">Disiplin</h1>
                <p class="text-justify text-xs sm:text-sm leading-relaxed">
                    Kami memiliki konsultan hukum dengan keterampilan, pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white text-black shadow-2xl rounded-lg px-4 sm:px-6 py-6 sm:py-8" style="transition-delay: 300ms;">
                <img src="{{ Vite::asset('resources/asset/icon/effective.png') }}" alt=""
                    class="icon-animate mx-auto mt-2 mb-4 sm:mb-6 h-16 sm:h-20">
                <h1 class="text-center text-lg sm:text-xl font-bold mb-3 sm:mb-4">Efektif dan Efisien</h1>
                <p class="text-xs sm:text-sm leading-relaxed text-justify">
                    Kami memiliki konsultan hukum dengan keterampilan, pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.
                </p>
            </div>
        </div>
    </div>
    <div class="parallax-element bg-white shadow-lg grid grid-cols-1 lg:grid-cols-2 py-12 sm:py-16 md:py-20 gap-6 lg:gap-0">
        <div class="text-center font-bold text-xl sm:text-2xl md:text-3xl flex px-4 sm:px-8 md:px-12 lg:px-20 justify-center lg:justify-end items-center order-1 lg:order-1">
            <h1>KONTEN SELANJUTNYA</h1>
        </div>
        <div class="text-sm sm:text-base md:text-lg lg:text-xl px-4 sm:px-8 md:px-10 lg:px-10 flex justify-center lg:justify-start items-center order-2 lg:order-2">
            <p class="text-center lg:text-left">
                ATS LAW FIRM siap menjadi kantor hukum yang dapat di percaya dengan mengutamakan profesionalitas,
                dedikasi, disiplin, efektif dan Efisien yang berintegritas.
            </p>
        </div>
    </div>
    <div id="profile" class="parallax-element bg-gray-200 grid grid-cols-1 lg:grid-cols-2 px-4 sm:px-6 md:px-12 lg:px-20 py-12 sm:py-16 md:py-20 gap-6 lg:gap-8">
        <div class="w-full flex justify-center items-center">
            <img src="{{ Vite::asset('resources/asset/home/owner.png') }}" alt="" class="w-full max-w-md lg:max-w-full h-auto object-contain">
        </div>
        <div class="w-full">
            <div class="flex flex-col mb-4 sm:mb-6">
                <h1 class="text-lg sm:text-xl md:text-2xl mb-2 font-bold">AHMAD MUZAYIN, S.H., M.H., C.T.L., C.R.A.</h1>
                <h2 class="mb-2 text-base sm:text-lg md:text-xl text-amber-600 font-semibold">Bankruptcy Lawyer I Founder ATS Law Firm</h2>
                <p class="leading-relaxed text-justify text-sm sm:text-base">
                    Sebelum mendirikan ATS LAW FIRM, ia pernah bergabung dengan beberapa kantor hukum di Jakarta dan
                    aktif pada Lembaga Bantuan Hukum dari tahun 2012. Ia telah menangani beberapa kasus tindak pidana korupsi
                    berskala nasional dari tahun 2016 hingga saat ini. Ia memiliki kemampuan menangani perkara
                    kepailitan, korupsi, ketenagakerjaan, perbankan dan pertanahan.
                </p>
            </div>
            <div class="border-t border-gray-400 pt-4 mb-4 sm:mb-6">
                <h1 class="text-base sm:text-lg md:text-xl font-bold mb-2">Pendidikan</h1>
                <div class="px-4 sm:px-8 md:px-12 flex flex-col space-y-1 sm:space-y-2 text-sm sm:text-base">
                    <li>Sarjana Hukum, Universitas Trisakti – 2015</li>
                    <li>Magister Hukum, Universitas Trisakti – 2021</li>
                </div>
            </div>
            <div class="border-t border-gray-400 pt-4 mb-4 sm:mb-6">
                <h1 class="text-base sm:text-lg md:text-xl font-bold mb-2">Pendidikan Profesi</h1>
                <div class="px-4 sm:px-8 md:px-12 flex flex-col space-y-1 sm:space-y-2 text-sm sm:text-base">
                    <li>Pendidikan Khusus Profesi Advokat (PERADI) – 2017</li>
                    <li>Pendidikan Khusus Pengacara Pajak (PERJAKIN) – 2019</li>
                    <li>Pendidikan Sertifikasi Kurator dan Pengurus (HKPI) – 2020</li>
                    <li>Pendidikan Konsultan Hukum Pasar Modal (HKHPM) – 2021</li>
                </div>
            </div>
            <div class="border-t border-gray-400 pt-4 mb-4 sm:mb-6">
                <h1 class="text-base sm:text-lg md:text-xl font-bold mb-2">Pengabdian</h1>
                <div class="px-4 sm:px-8 md:px-12 flex flex-col space-y-1 sm:space-y-2 text-sm sm:text-base">
                    <li>Pengurus DPP Asosiasi Advokat Indonesia – 2022 s.d 2027</li>
                </div>
            </div>
        </div>
    </div>
    <div class="parallax-element grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 py-12 sm:py-16 md:py-20 px-4 sm:px-6">
        <div class="flex justify-center items-center text-2xl sm:text-3xl md:text-4xl font-bold">
            <h1>Part Of</h1>
        </div>
        <div class="flex justify-center lg:justify-start items-center">
            <img src="{{ Vite::asset('resources/asset/home/part-of.png') }}" alt="" class="w-full max-w-sm lg:max-w-md h-auto object-contain">
        </div>
    </div>
    <div class="relative overflow-hidden min-h-[600px]">
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="bg-black/80 w-full h-full relative">
                <img src="{{ Vite::asset('resources/asset/home/bg3.png') }}" alt="background"
                    class="bg-parallax-layer absolute left-0 w-full object-cover opacity-30">
            </div>
        </div>
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-base sm:text-lg md:text-xl text-gray-300 mb-2">Ruang Lingkup</h2>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white">Jasa Hukum</h1>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 max-w-7xl mx-auto">
                <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                        <img src="{{ Vite::asset('resources/asset/icon/legal-dokumen.png') }}" alt="Legal Document Icon"
                            class="icon-animate w-full h-full object-contain">
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Jasa Hukum Retainer</h3>
                    <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                        Memberikan pelayanan hukum kepada perusahaan yang mencangkup semua bidang hukum yang berhubungan
                        dengan kegiatan perusahaan dalam jangka waktu tertentu, yang mana lingkup pekerjaanya berlangsung
                        secara rutin dan berkesinambungan sesuai dengan kebutuhan perusahaan.
                    </p>
                </div>
                <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center" style="transition-delay: 100ms;">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                        <img src="{{ Vite::asset('resources/asset/icon/legal-dokumen2.png') }}" alt="Legal Document Icon"
                            class="icon-animate w-full h-full object-contain">
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Jasa Hukum per Kasus</h3>
                    <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                        Pelayanan jasa hukum yang akan diberikan kepada perusahaan apabila di pandang permasalahan hukum tersebut rumit dan tidak masuk dalam kriteria jasa hukum retainer, maka kami akan membuat penawaran jasa hukum secara terpisah yang mencangkup lingkup pekerjaan, biaya dan tata cara pembayaran.
                    </p>
                </div>
                <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center md:col-span-2 lg:col-span-1" style="transition-delay: 200ms;">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                        <img src="{{ Vite::asset('resources/asset/icon/palu.png') }}" alt="Legal Document Icon"
                            class="icon-animate w-full h-full object-contain">
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Jasa Hukum Litigasi</h3>
                    <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                        Pelayanan jasa hukum ini meliputi tindakan-tindakan hukum terkait dengan proses di lembaga peradilan, kepolisian, kejaksaan dan lembaga lainnya baik yang bersifat perdata maupun pidana yang kaitanya dengan permasalahan hukum klien berbentuk perusahaan maupun perorangan.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 sm:py-16 md:py-20 px-4 sm:px-6">
        <div class="text-center font-bold text-2xl sm:text-3xl md:text-4xl mb-8 sm:mb-10">
            <h1>Keahlian Kami</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 max-w-7xl mx-auto">
            <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                    <img src="{{ Vite::asset('resources/asset/icon/bank-batang.png') }}" alt="Legal Document Icon"
                        class="icon-animate w-full h-full object-contain">
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Kepailitan</h3>
                <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                    Kami memberikan pelayanan jasa hukum terkait dengan kepailitan atau kebangkrutan perusahaan maupun perorangan namun tidak terbatas mekanisme penundaan kewajiban pembayaran utang baik dari kreditur maupun debitur yang sedang mengalami permasalahan keuangan untuk menjalankan usahanya.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center" style="transition-delay: 100ms;">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                    <img src="{{ Vite::asset('resources/asset/icon/bribe.png') }}" alt="Legal Document Icon"
                        class="icon-animate w-full h-full object-contain">
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Korupsi</h3>
                <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                    Kami berpengalaman menangani klien kami yang tersangkut perkara tindak pidana korupsi khususnya yang berkaitan dengan Komisi Pemberantasan Korupsi Republik Indonesia, oleh karenanya kami akan memberikan pelayanan jasa hukum yang terbaik demi tercapainya kepentingan hukum klien serta menjaga hak-hak klien kami.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center" style="transition-delay: 200ms;">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                    <img src="{{ Vite::asset('resources/asset/icon/employee.png') }}" alt="Legal Document Icon"
                        class="icon-animate w-full h-full object-contain">
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Ketenagakerjaan</h3>
                <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                    Pelayanan jasa hukum ini meliputi pengaturan hak dan kewajiban pekerja dengan pengusaha dalam hal pendayagunaan tenaga kerja secara optimal, menyelesaikan perselisihan antara pekerja dengan pengusaha dan apabila diperlukan penyelesaian melalui Pengadilan Hubungan Industrial, maka kami akan memberikan pelayanan terbaik untuk klien kami.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center" style="transition-delay: 300ms;">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                    <img src="{{ Vite::asset('resources/asset/icon/bank.png') }}" alt="Legal Document Icon"
                        class="icon-animate w-full h-full object-contain">
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Perbankan</h3>
                <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                    Kami telah di percaya dalam menyelesaikan permasalahan perbankan seperti halnya kredit macet, Aset Yang Diambil Alih (AYDA), eksekusi hak tanggungan dan lain sebagainya, oleh karenanya setiap kami menyelesaikan permasalahan perbankan kami akan melihat perspektif dari bank maupun nasabah demi tercapainya kepastian hukum.
                </p>
            </div>
            <div class="parallax-element hover-card-effect bg-white shadow-2xl rounded-lg p-4 sm:p-6 lg:p-8 flex flex-col items-center text-center sm:col-span-2 lg:col-span-1" style="transition-delay: 400ms;">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mb-4 sm:mb-6 flex items-center justify-center">
                    <img src="{{ Vite::asset('resources/asset/icon/location-pin.png') }}" alt="Legal Document Icon"
                        class="icon-animate w-full h-full object-contain">
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-800">Pertanahan</h3>
                <p class="text-xs sm:text-sm md:text-base text-gray-600 leading-relaxed text-justify">
                    Kami siap melayani apabila terjadi permasalahan seperti penyerobotan lahan, tumpang tindih kepemilikan hak atas tanah, berkorespondensi dengan Badan Pertanahan Nasional seluruh Indonesia dan permasalahan lainnya yang berkaitan dengan hak atas tanah di Indonesia.
                </p>
            </div>
        </div>
    </div>
    <div class="parallax-element bg-gradient-to-b from-gray-50 to-white py-12 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    Klien Kami
                </h2>
                <p class="text-sm sm:text-base text-gray-600">Dipercaya oleh perusahaan terkemuka</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach(range(1, 8) as $i)
                <div class="parallax-element bg-white border-2 border-gray-200 rounded-xl p-6 sm:p-8 flex items-center justify-center hover:border-red-900 hover:shadow-lg transition-all duration-300" style="transition-delay: {{$i * 50}}ms">
                    <img src="{{ Vite::asset('resources/asset/home/logo'.$i.'.png') }}" alt="Logo {{$i}}" class="w-full h-auto max-h-16 sm:max-h-20 object-contain filter hover:brightness-110 transition-all">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class=""></div>    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fadeObserverOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            const fadeObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        fadeObserver.unobserve(entry.target); // Hanya animasi sekali
                    }
                });
            }, fadeObserverOptions);
            const parallaxElements = document.querySelectorAll('.parallax-element');
            parallaxElements.forEach(el => fadeObserver.observe(el));
            const iconObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('show-icon');
                        }, 100);
                        iconObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            const icons = document.querySelectorAll('.icon-animate');
            icons.forEach(icon => iconObserver.observe(icon));
            let ticking = false;
            function parallaxScroll() {
                const bgImages = document.querySelectorAll('.bg-parallax-layer');
                bgImages.forEach((bg) => {
                    const parent = bg.parentElement;
                    if (parent) {
                        const rect = parent.getBoundingClientRect();
                        if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                            const speed = 0.5; // Kecepatan lebih tinggi agar terlihat jelas
                            const yPos = rect.top * speed;
                            bg.style.transform = `translateY(${yPos}px) scale(1.2)`;
                        }
                    }
                });
                ticking = false;
            }
            function requestTick() {
                if (!ticking) {
                    window.requestAnimationFrame(parallaxScroll);
                    ticking = true;
                }
            }
            window.addEventListener('scroll', requestTick);
            requestTick();
        });
    </script>
</x-layout>
<x-footer />