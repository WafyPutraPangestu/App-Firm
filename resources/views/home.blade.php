<x-layout>
    <div class="bg-red-900 text-white grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="flex justify-center items-center text-2xl font-bold px-6">
            <h1>Kami adalah <strong class="text-yellow-100">pilihan yang terbaik</strong> untuk menyelesaikan setiap
                permasalahan hukum anda.
            </h1>
        </div>
        <div class="">
            <img src="{{ Vite::asset('resources/asset/home/bg1.png') }}" alt="background" class="rounded-tl-[60px]">
        </div>
    </div>

    <div class="bg-white py-15"></div>

    <!-- Section About Us dengan Background -->
    <div class="relative w-full">
        <!-- Background Image Layer -->
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <div class="bg-black/80 w-full h-full">
                <img src="{{ Vite::asset('resources/asset/home/bg1.png') }}" alt="background"
                    class="w-full h-full object-cover opacity-30">
            </div>
        </div>

        <!-- Content Layer -->
        <div class="relative z-10 px-6 md:px-20 py-20 text-white">
            <div class="rounded-lg p-8 md:p-12 space-y-4">
                <p class="text-justify text-xl leading-relaxed">
                    ATS LAW FIRM pertama kali berdiri pada tanggal 27 Oktober 2015 di Jakarta dengan nama Ahmad,
                    Tangkudung,
                    Sismoyo & Associate yang di prakarsai oleh Ahmad Muzayin, Arisaka W. Tangkudung dan Hendro Sismoyo.
                    Pada
                    tanggal 18 Mei 2018 membubarkan diri karena salah satu pendiri menjadi hakim serta tingginya
                    aktivitas dan
                    kesibukan tiap partner, sesuai dengan Akta Pembubaran Firma Hukum "Ahmad, Tangkudung, Sismoyo &
                    Associate".
                </p>
                <p class="text-justify text-xl leading-relaxed">
                    Kemudian pada tanggal 6 Mei 2020, Ahmad Muzayin dan Abdul Khalim kembali mendirikan firma hukum
                    dengan nama
                    Attorney, Trusted & Solution (ATS LAW FIRM). Berbagai kasus penting baik kasus perdata maupun pidana
                    skala
                    nasional telah ditanganinya dengan berbekal profesionalisme, etos kerja serta jaringan yang kuat dan
                    luas.
                </p>
                <p class="text-justify text-xl leading-relaxed">
                    ATS LAW FIRM hingga saat ini telah memberikan pelayanan hukum untuk perorangan maupun perusahaan,
                    kami
                    menyediakan konsultan hukum yang berkualitas dan professional dalam melayani setiap kebutuhan klien
                    untuk
                    mencegah permasalahan hukum yang akan timbul dan/atau yang sedang kami tangani dengan menyediakan
                    produk
                    hukum yang berkualitas dengan harga yang kompetitif.
                </p>
                <p class="text-center text-xl leading-relaxed">
                    Dalam waktu yang singkat kami <strong class="text-yellow-600">berinovasi dan
                        berkomitmen</strong> sehingga mendapatkan
                    reputasi yang baik.
                </p>
                <h1 class="text-yellow-600 text-center text-3xl leading-relaxed font-extrabold mt-8">Kenapa Memilih Kami
                </h1>
            </div>
        </div>
    </div>

    <!-- Section Cards - Kenapa Memilih Kami -->
    <div class="bg-gradient-to-b from-black/80 to-white px-6 md:px-20 pt-8 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white text-black shadow-2xl rounded-lg px-6 py-8 hover:shadow-xl transition-shadow">
                <img src="{{ Vite::asset('resources/asset/icon/businessman.png') }}" alt=""
                    class="mx-auto mt-2 mb-6 h-20">
                <h1 class="text-center text-xl font-bold mb-4">Profesional</h1>
                <p class="text-center text-sm leading-relaxed">Kami memiliki konsultan hukum dengan keterampilan,
                    pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.</p>
            </div>
            <div class="bg-white text-black shadow-2xl rounded-lg px-6 py-8 hover:shadow-xl transition-shadow">
                <img src="{{ Vite::asset('resources/asset/icon/time-management.png') }}" alt=""
                    class="mx-auto mt-2 mb-6 h-20">
                <h1 class="text-center text-xl font-bold mb-4">Berdedikasi</h1>
                <p class="text-center text-sm leading-relaxed">Kami memiliki konsultan hukum dengan keterampilan,
                    pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.</p>
            </div>
            <div class="bg-white text-black shadow-2xl rounded-lg px-6 py-8 hover:shadow-xl transition-shadow">
                <img src="{{ Vite::asset('resources/asset/icon/discipline.png') }}" alt=""
                    class="mx-auto mt-2 mb-6 h-20">
                <h1 class="text-center text-xl font-bold mb-4">Disiplin</h1>
                <p class="text-center text-sm leading-relaxed">Kami memiliki konsultan hukum dengan keterampilan,
                    pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.</p>
            </div>
            <div class="bg-white text-black shadow-2xl rounded-lg px-6 py-8 hover:shadow-xl transition-shadow">
                <img src="{{ Vite::asset('resources/asset/icon/effective.png') }}" alt=""
                    class="mx-auto mt-2 mb-6 h-20">
                <h1 class="text-center text-xl font-bold mb-4">Efektif dan Efisien</h1>
                <p class="text-center text-sm leading-relaxed">Kami memiliki konsultan hukum dengan keterampilan,
                    pengetahuan dan sikap yang tepat dalam memecahkan
                    masalah hukum klien serta terjaminnya kerahasian klien.</p>
            </div>
        </div>
    </div>

    <!-- Tempat untuk konten selanjutnya -->
    <div class="bg-white shadow-lg grid grid-cols-1 md:grid-cols-2  py-20 ">
        <div class="text-center font-bold text-2xl flex px-8 md:px-20 justify-end items-center ">
            <h1>KONTENT SELANJUTNYA</h1>
        </div>
        <div class="text-xl px-8 md:px-10 flex justify-start items-center ">
            <p>ATS LAW FIRM siap menjadi kantor hukum yang dapat di percaya dengan mengutamakan profesionalitas,
                dedikasi, disiplin, efektif dan Efisien yang berintegritas.</p>
        </div>
    </div>
    <div class="bg-gray-200 grid grid-cols-1 md:grid-cols-2 px-6 md:px-20 py-20 gap-4">
        <div class="">
            <img src="{{ Vite::asset('resources/asset/home/owner.png') }}" alt="" srcset="">
        </div>
        <div class="">
            <div class="flex flex-col mb-6">
                <h1 class="text-2xl mb-2">AHMAD MUZAYIN, S.H., M.H., C.T.L., C.R.A.</h1>
                <h2 class="mb-2 text-xl text-amber-600">Bankruptcy Lawyer I Founder ATS Law Firm</h2>
                <p>Sebelum mendirikan ATS LAW FIRM, ia pernah bergabung dengan beberapa kantor hukum di Jakarta dan
                    aktif
                    pada Lembaga Bantuan Hukum dari tahun 2012. Ia telah menangani beberapa kasus tindak pidana korupsi
                    berskala nasional dari tahun 2016 hingga saat ini. Ia memiliki kemampuan menangani perkara
                    kepailitan,
                    korupsi, ketenagakerjaan, perbankan dan pertanahan.</p>
            </div>
            <div class="border-t-1 mb-6 ">
                <h1 class="text-xl font-bold mt-4">Pendidikan</h1>
                <div class="px-8 md:px-12 mt-2 flex flex-col space-y-2">
                    <li>Sarjana Hukum, Universitas Trisakti – 2015</li>
                    <li>Magister Hukum, Universitas Trisakti – 2021</li>
                </div>
            </div>
            <div class="border-t-1 mb-6 ">
                <h1 class="mt-4 text-xl font-bold">Pendidikan Profesi</h1>
                <div class="px-8 md:px-12 mt-2 flex flex-col space-y-2">
                    <li>Pendidikan Khusus Profesi Advokat (PERADI) – 2017</li>
                    <li>Pendidikan Khusus Pengacara Pajak (PERJAKIN) – 2019</li>
                    <li>Pendidikan Sertifikasi Kurator dan Pengurus (HKPI) – 2020 </li>
                    <li>Pendidikan Konsultan Hukum Pasar Modal (HKHPM) – 2021 </li>
                </div>
            </div>
            <div class="border-t-1 mb-6 ">
                <h1 class="text-xl font-bold mt-4">Pengabdian</h1>
                <div class="px-8 md:px-12 mt-2 flex flex-col space-y-2">
                    <li>Pengurus DPP Asosiasi Advokat Indonesia – 2022 s.d 2027</li>
                </div>
            </div>
        </div>
    </div>

    {{-- part of --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-20">
        <div class="flex justify-center items-center text-4xl font-bold ">
            <h1>Part Of</h1>
        </div>
        <div class="flex justify-start mr-10">
            <img src="{{ Vite::asset('resources/asset/home/part-of.png') }}" alt="" srcset="">
        </div>
    </div>
    {{-- ruang lingkup --}}
    <div class="grid grid-cols-1 md:grid-cols-2 bg-red-200  gap-4 py-10">
        <div class="flex flex-col  mb-10">
            <h2>Ruang Lingkup</h2>
            <h1>Jasa Hukum</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 md:px-20">
            <div class="bg-white shadow-2xl rounded-lg px-6 py-8 mb-6 flex flex-col ">
                <img src="{{ Vite::asset('resources/asset/icon/legal-dokumen.png') }}" alt=""
                    class="mx-auto mb-4 h-20">
                <h1 class="text-xl text-center">Jasa Hukum Retainer</h1>
                <p>Memberikan pelayanan hukum kepada perusahaan yang mencangkup semua bidang hukum yang berhubungan
                    dengan kegiatan perusahaan dalam jangka waktu tertentu, yang mana lingkup pekerjaanya berlangsung
                    secara rutin dan berkesinambungan sesuai dengan kebutuhan perusahaan.</p>
            </div>
            <div class="bg-white shadow-2xl rounded-lg px-6 py-8 mb-6 flex flex-col ">
                <img src="{{ Vite::asset('resources/asset/icon/legal-dokumen.png') }}" alt=""
                    class="mx-auto mb-4 h-20">
                <h1 class="text-xl text-center">Jasa Hukum Retainer</h1>
                <p>Memberikan pelayanan hukum kepada perusahaan yang mencangkup semua bidang hukum yang berhubungan
                    dengan kegiatan perusahaan dalam jangka waktu tertentu, yang mana lingkup pekerjaanya berlangsung
                    secara rutin dan berkesinambungan sesuai dengan kebutuhan perusahaan.</p>
            </div>
            <div class="bg-white shadow-2xl rounded-lg px-6 py-8 mb-6 flex flex-col ">
                <img src="{{ Vite::asset('resources/asset/icon/legal-dokumen.png') }}" alt=""
                    class="mx-auto mb-4 h-20">
                <h1 class="text-xl text-center">Jasa Hukum Retainer</h1>
                <p>Memberikan pelayanan hukum kepada perusahaan yang mencangkup semua bidang hukum yang berhubungan
                    dengan kegiatan perusahaan dalam jangka waktu tertentu, yang mana lingkup pekerjaanya berlangsung
                    secara rutin dan berkesinambungan sesuai dengan kebutuhan perusahaan.</p>
            </div>
        </div>
    </div>
</x-layout>
