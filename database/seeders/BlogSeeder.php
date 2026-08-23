<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Branch;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['name' => 'Pendidikan'],
            [
                'description' => 'Kategori untuk artikel edukasi seputar sistem informasi, teknologi, dan pengembangan kompetensi mahasiswa.',
                'active' => true,
            ],
        );

        $branch = Branch::firstOrCreate(
            ['name' => 'DPP HIMSI'],
            [
                'location' => 'Universitas',
                'thumbnail' => 'branch/dpp-himsi.jpg',
                'description' => 'Branch default untuk kebutuhan data awal artikel dan publikasi Website HIMSI.',
                'grup_wa' => 'https://chat.whatsapp.com/',
                'sektor' => 'Pusat',
                'sosial_media' => [
                    'instagram' => 'https://instagram.com/himsi',
                    'website' => 'https://himsi.test',
                ],
                'is_dpp' => true,
                'active' => true,
            ],
        );

        $blogs = [
            [
                'title' => 'Apa Itu UI/UX dan Mengapa Penting untuk Sistem Informasi',
                'thumbnail' => 'https://picsum.photos/seed/himsi-uiux/1200/800',
                'quotes' => 'UI/UX membantu sistem tidak hanya berjalan, tetapi juga nyaman dipakai.',
                'body' => [
                    'UI/UX adalah bidang yang membahas bagaimana pengguna melihat, memahami, dan merasakan sebuah produk digital. UI atau user interface berfokus pada tampilan antarmuka seperti warna, tombol, tipografi, ikon, dan susunan halaman. UX atau user experience berfokus pada pengalaman pengguna dari awal sampai akhir ketika menyelesaikan kebutuhan tertentu di dalam sistem.',
                    'Dalam jurusan Sistem Informasi, UI/UX penting karena mahasiswa tidak hanya belajar membuat aplikasi yang berfungsi secara teknis. Mahasiswa juga perlu memahami kebutuhan pengguna, alur kerja bisnis, dan cara menyusun solusi digital yang mudah dipakai. Sistem yang kuat secara logika tetapi sulit digunakan tetap bisa gagal ketika diterapkan di dunia nyata.',
                    'Contoh sederhana terlihat pada aplikasi pendaftaran organisasi. Jika form terlalu panjang, label tidak jelas, atau tombol aksi sulit ditemukan, pengguna bisa berhenti sebelum menyelesaikan pendaftaran. Dengan pendekatan UX, alur tersebut bisa dirancang lebih ringkas, validasi dibuat lebih jelas, dan informasi penting diletakkan pada posisi yang mudah dipahami.',
                    'Mahasiswa Sistem Informasi yang memahami UI/UX akan lebih siap bekerja dalam tim produk digital. Mereka bisa menjadi jembatan antara kebutuhan pengguna, tujuan bisnis, dan kemampuan teknis developer. Kemampuan ini relevan untuk peran seperti product designer, business analyst, system analyst, maupun frontend developer.',
                ],
            ],
            [
                'title' => 'Apa Itu Programming untuk Mahasiswa Sistem Informasi',
                'thumbnail' => 'https://picsum.photos/seed/himsi-programming/1200/800',
                'quotes' => 'Programming adalah alat untuk menerjemahkan kebutuhan menjadi sistem yang bisa digunakan.',
                'body' => [
                    'Programming adalah proses menulis instruksi agar komputer dapat menjalankan tugas tertentu. Instruksi tersebut ditulis menggunakan bahasa pemrograman seperti PHP, JavaScript, Python, Java, atau bahasa lain sesuai kebutuhan sistem. Untuk mahasiswa Sistem Informasi, programming bukan sekadar hafalan sintaks, tetapi cara berpikir untuk memecahkan masalah secara terstruktur.',
                    'Dalam konteks Sistem Informasi, programming biasanya digunakan untuk membangun aplikasi yang mendukung proses bisnis. Contohnya sistem akademik, sistem kasir, dashboard organisasi, aplikasi pendaftaran, hingga website profil. Setiap fitur yang terlihat sederhana di layar biasanya memiliki proses logika, validasi data, penyimpanan database, dan keamanan akses di belakangnya.',
                    'Belajar programming juga melatih mahasiswa memahami hubungan antara data, proses, dan pengguna. Ketika membuat fitur login, misalnya, mahasiswa belajar tentang input, hashing password, session, database user, dan proteksi halaman. Pemahaman seperti ini membuat mahasiswa lebih mudah berdiskusi dengan developer maupun stakeholder non-teknis.',
                    'Mahasiswa tidak harus langsung menguasai semua bahasa pemrograman. Lebih penting untuk memahami dasar seperti variabel, percabangan, perulangan, fungsi, struktur data, database, dan konsep debugging. Jika dasar tersebut kuat, berpindah ke framework atau bahasa baru akan jauh lebih mudah.',
                ],
            ],
            [
                'title' => 'Peran Database dalam Sistem Informasi Modern',
                'thumbnail' => 'https://picsum.photos/seed/himsi-database/1200/800',
                'quotes' => 'Database adalah pusat penyimpanan fakta yang membuat sistem dapat dipercaya.',
                'body' => [
                    'Database adalah komponen utama dalam hampir semua sistem informasi. Di dalam database, data pengguna, transaksi, artikel, dokumen, status, dan riwayat aktivitas disimpan secara terstruktur. Tanpa database yang baik, aplikasi hanya menjadi tampilan kosong yang tidak mampu menyimpan dan mengelola informasi secara konsisten.',
                    'Mahasiswa Sistem Informasi perlu memahami database karena banyak keputusan sistem bergantung pada rancangan data. Struktur tabel, relasi, tipe data, index, dan constraint akan memengaruhi performa serta kualitas informasi. Kesalahan kecil seperti tipe kolom yang tidak tepat atau relasi yang tidak jelas bisa menyulitkan pengembangan fitur berikutnya.',
                    'Dalam dunia kerja, database juga berkaitan erat dengan kebutuhan laporan dan pengambilan keputusan. Data yang tersimpan rapi dapat diolah menjadi dashboard, grafik, dan insight bisnis. Sebaliknya, data yang tidak konsisten akan menghasilkan laporan yang membingungkan dan sulit dipertanggungjawabkan.',
                    'Belajar database sebaiknya dimulai dari konsep dasar seperti primary key, foreign key, normalisasi, query SQL, dan relasi antar tabel. Setelah itu, mahasiswa dapat mempelajari migration, ORM, backup, keamanan data, dan optimasi query sesuai kebutuhan proyek.',
                ],
            ],
            [
                'title' => 'Mengenal Business Analyst dalam Pengembangan Sistem',
                'thumbnail' => 'https://picsum.photos/seed/himsi-business-analyst/1200/800',
                'quotes' => 'Business analyst memastikan sistem yang dibuat benar-benar menjawab kebutuhan.',
                'body' => [
                    'Business analyst adalah peran yang menjembatani kebutuhan bisnis dengan solusi teknologi. Dalam proyek pengembangan sistem, business analyst membantu menggali masalah, merapikan kebutuhan, membuat dokumentasi, dan memastikan tim teknis memahami konteks yang benar. Peran ini sangat dekat dengan kompetensi mahasiswa Sistem Informasi.',
                    'Seorang business analyst tidak hanya mencatat permintaan pengguna. Ia perlu bertanya mengapa sebuah fitur dibutuhkan, siapa yang akan menggunakannya, proses apa yang berubah, dan dampak apa yang diharapkan. Dengan cara ini, solusi yang dibuat tidak sekadar mengikuti permintaan awal, tetapi benar-benar menyelesaikan masalah utama.',
                    'Contohnya ketika organisasi meminta sistem recruitment. Business analyst perlu memahami alur pendaftaran, dokumen yang dibutuhkan, status seleksi, siapa yang memverifikasi, dan laporan apa yang harus tersedia. Informasi tersebut kemudian diterjemahkan menjadi kebutuhan fitur, struktur data, dan prioritas pengerjaan.',
                    'Mahasiswa Sistem Informasi dapat mulai melatih kemampuan business analysis melalui wawancara pengguna, membuat flowchart, menulis user story, menyusun use case, dan memvalidasi kebutuhan. Kemampuan komunikasi, analisis proses, dan dokumentasi menjadi modal penting untuk peran ini.',
                ],
            ],
            [
                'title' => 'Dasar System Analyst untuk Mahasiswa Sistem Informasi',
                'thumbnail' => 'https://picsum.photos/seed/himsi-system-analyst/1200/800',
                'quotes' => 'System analyst mengubah kebutuhan menjadi rancangan sistem yang siap dibangun.',
                'body' => [
                    'System analyst adalah peran yang fokus pada analisis dan perancangan sistem. Jika business analyst banyak membahas kebutuhan bisnis, system analyst menerjemahkan kebutuhan tersebut menjadi rancangan teknis yang lebih detail. Rancangan ini dapat berupa diagram, spesifikasi modul, struktur database, dan alur integrasi.',
                    'Dalam jurusan Sistem Informasi, kemampuan system analysis penting karena mahasiswa sering berada di antara sisi bisnis dan sisi teknis. Mahasiswa perlu memahami proses organisasi, tetapi juga cukup paham teknologi untuk merancang solusi yang realistis. Di sinilah kemampuan membaca kebutuhan dan menyusunnya menjadi rancangan sistem menjadi sangat berguna.',
                    'Contoh pekerjaan system analyst adalah membuat ERD untuk database, menyusun activity diagram, menentukan hak akses pengguna, dan mendefinisikan validasi pada setiap form. Rancangan tersebut membantu developer bekerja lebih terarah dan mengurangi risiko salah paham ketika fitur mulai dibangun.',
                    'Untuk memulai, mahasiswa dapat belajar UML dasar, konsep database, dokumentasi kebutuhan, dan arsitektur aplikasi web. Kemampuan berpikir sistematis dan teliti menjadi kunci karena rancangan yang kurang jelas biasanya akan menimbulkan masalah pada tahap implementasi.',
                ],
            ],
            [
                'title' => 'Mengapa Data Analytics Relevan untuk Sistem Informasi',
                'thumbnail' => 'https://picsum.photos/seed/himsi-data-analytics/1200/800',
                'quotes' => 'Data analytics membantu organisasi membaca kondisi dan mengambil keputusan.',
                'body' => [
                    'Data analytics adalah proses mengolah data menjadi informasi yang berguna untuk pengambilan keputusan. Dalam organisasi modern, hampir semua aktivitas menghasilkan data, mulai dari pendaftaran anggota, kunjungan website, transaksi, survei, hingga interaksi media sosial. Data tersebut dapat memberi gambaran tentang kondisi nyata jika dianalisis dengan benar.',
                    'Mahasiswa Sistem Informasi memiliki posisi yang cocok untuk mempelajari data analytics karena sudah terbiasa melihat hubungan antara proses bisnis dan teknologi. Mereka dapat memahami dari mana data berasal, bagaimana data disimpan, dan bagaimana hasil analisis digunakan oleh pengambil keputusan. Kombinasi ini membuat analisis tidak berhenti pada angka, tetapi sampai pada konteks.',
                    'Contoh sederhana adalah menganalisis data recruitment organisasi. Dari data tersebut, pengurus bisa melihat branch mana yang paling banyak diminati, status seleksi yang paling sering muncul, atau periode pendaftaran yang paling ramai. Insight seperti ini dapat digunakan untuk memperbaiki strategi sosialisasi dan proses seleksi berikutnya.',
                    'Untuk mulai belajar, mahasiswa dapat memahami spreadsheet, SQL, visualisasi data, statistik dasar, dan tools seperti Power BI atau Tableau. Setelah itu, kemampuan dapat ditingkatkan dengan Python, data cleaning, dashboard interaktif, dan interpretasi metrik.',
                ],
            ],
            [
                'title' => 'Keamanan Dasar pada Aplikasi Web',
                'thumbnail' => 'https://picsum.photos/seed/himsi-web-security/1200/800',
                'quotes' => 'Keamanan bukan fitur tambahan, tetapi bagian dari rancangan sistem.',
                'body' => [
                    'Keamanan aplikasi web adalah aspek penting yang harus dipahami sejak awal pengembangan. Sistem informasi biasanya menyimpan data pengguna, dokumen, dan proses organisasi yang tidak boleh diakses sembarang orang. Jika keamanan diabaikan, aplikasi bisa mengalami kebocoran data, penyalahgunaan akun, atau manipulasi informasi.',
                    'Mahasiswa Sistem Informasi perlu mengenal risiko umum seperti password lemah, SQL injection, cross-site scripting, upload file berbahaya, dan akses halaman tanpa otorisasi. Risiko tersebut sering muncul bukan karena teknologi yang buruk, tetapi karena developer tidak menerapkan validasi dan proteksi dengan disiplin.',
                    'Framework modern seperti Laravel sudah menyediakan banyak fitur keamanan, misalnya hashing password, CSRF protection, validasi input, migration, dan query builder yang membantu mencegah SQL injection. Namun fitur bawaan tetap harus digunakan dengan benar. Developer tetap bertanggung jawab menentukan hak akses, membatasi upload, dan menjaga konfigurasi environment.',
                    'Langkah awal yang bisa dilakukan mahasiswa adalah membiasakan validasi input, menggunakan autentikasi yang aman, tidak menyimpan password plain text, membatasi akses berdasarkan role, dan tidak menaruh kredensial di repository. Kebiasaan kecil ini akan membentuk cara kerja yang lebih aman saat membangun sistem nyata.',
                ],
            ],
            [
                'title' => 'Mengenal API dan Integrasi Sistem',
                'thumbnail' => 'https://picsum.photos/seed/himsi-api-integration/1200/800',
                'quotes' => 'API membuat sistem yang berbeda dapat saling bertukar data secara teratur.',
                'body' => [
                    'API atau application programming interface adalah mekanisme yang memungkinkan satu aplikasi berkomunikasi dengan aplikasi lain. Dalam sistem informasi, API sering dipakai untuk integrasi pembayaran, login pihak ketiga, pengiriman email, peta digital, notifikasi, dan pertukaran data antar layanan.',
                    'Mahasiswa Sistem Informasi perlu memahami API karena banyak solusi modern tidak berdiri sendiri. Sebuah website organisasi bisa terhubung dengan layanan email, cloud storage, analytics, atau aplikasi internal lain. Dengan API, sistem dapat berkembang tanpa harus membangun semua fitur dari nol.',
                    'Konsep penting dalam API meliputi endpoint, request, response, method HTTP, status code, token autentikasi, dan format data seperti JSON. Ketika frontend meminta daftar artikel, misalnya, backend dapat mengirim response JSON yang kemudian ditampilkan dalam bentuk card atau tabel.',
                    'Belajar API juga membantu mahasiswa memahami pemisahan antara frontend dan backend. Frontend fokus pada pengalaman pengguna, sementara backend fokus pada logika, database, keamanan, dan integrasi. Pemahaman ini penting untuk bekerja dalam tim pengembangan aplikasi modern.',
                ],
            ],
            [
                'title' => 'Manajemen Proyek Teknologi untuk Mahasiswa',
                'thumbnail' => 'https://picsum.photos/seed/himsi-project-management/1200/800',
                'quotes' => 'Proyek teknologi yang baik membutuhkan komunikasi, prioritas, dan dokumentasi.',
                'body' => [
                    'Manajemen proyek teknologi adalah proses mengatur pekerjaan agar pengembangan sistem berjalan terarah. Proyek aplikasi tidak hanya berisi coding, tetapi juga perencanaan, pembagian tugas, komunikasi, pengujian, dokumentasi, dan evaluasi. Tanpa pengelolaan yang baik, proyek mudah terlambat atau menghasilkan fitur yang tidak sesuai kebutuhan.',
                    'Mahasiswa Sistem Informasi sering mengerjakan proyek kelompok, baik untuk tugas kuliah maupun organisasi. Situasi ini menjadi tempat yang baik untuk belajar membuat backlog, menentukan prioritas, membagi peran, dan memantau progres. Tools sederhana seperti Trello, Notion, GitHub Projects, atau spreadsheet sudah cukup untuk tahap awal.',
                    'Dalam proyek teknologi, perubahan kebutuhan hampir selalu terjadi. Karena itu, tim perlu memiliki dokumentasi yang jelas dan komunikasi yang rutin. Jika ada perubahan fitur, dampaknya perlu dilihat terhadap database, tampilan, waktu pengerjaan, dan pengujian.',
                    'Kemampuan manajemen proyek membuat mahasiswa lebih siap bekerja di lingkungan profesional. Mereka tidak hanya memahami teknis aplikasi, tetapi juga memahami bagaimana sebuah solusi direncanakan, dikoordinasikan, dan diselesaikan bersama tim.',
                ],
            ],
            [
                'title' => 'Karier Digital untuk Lulusan Sistem Informasi',
                'thumbnail' => 'https://picsum.photos/seed/himsi-digital-career/1200/800',
                'quotes' => 'Sistem Informasi membuka banyak jalur karier di antara bisnis dan teknologi.',
                'body' => [
                    'Lulusan Sistem Informasi memiliki peluang karier yang luas karena mempelajari bisnis, data, teknologi, dan manajemen sistem. Kombinasi tersebut dibutuhkan oleh banyak organisasi yang sedang melakukan transformasi digital. Mahasiswa dapat memilih jalur yang lebih teknis, analitis, desain produk, atau manajerial sesuai minat.',
                    'Beberapa jalur karier yang umum adalah business analyst, system analyst, data analyst, UI/UX designer, product manager, web developer, database administrator, IT consultant, dan project manager. Setiap peran memiliki fokus berbeda, tetapi semuanya membutuhkan pemahaman tentang bagaimana teknologi membantu proses organisasi.',
                    'Untuk memilih jalur karier, mahasiswa dapat mulai dari mencoba proyek kecil. Jika senang merancang tampilan dan memahami pengguna, UI/UX bisa menjadi pilihan. Jika senang mengolah angka dan membuat dashboard, data analytics menarik untuk dipelajari. Jika senang membangun fitur, web development bisa menjadi jalur yang tepat.',
                    'Yang paling penting adalah membangun portofolio dan kebiasaan belajar. Dunia teknologi berubah cepat, sehingga kemampuan beradaptasi menjadi modal utama. Mahasiswa Sistem Informasi yang aktif membuat proyek, menulis dokumentasi, dan memahami kebutuhan pengguna akan memiliki nilai tambah di dunia kerja.',
                ],
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['slug' => Str::slug($blog['title'])],
                [
                    'branch_id' => $branch->id,
                    'title' => $blog['title'],
                    'thumbnail' => $blog['thumbnail'],
                    'quotes' => $blog['quotes'],
                    'body' => collect($blog['body'])->map(fn (string $paragraph): string => "<p>{$paragraph}</p>")->implode("\n"),
                    'category_id' => $category->id,
                    'active' => true,
                ],
            );
        }

        // Category Kegiatan for Activity Gallery Showcase
        $kegiatanCategory = Category::firstOrCreate(
            ['name' => 'Kegiatan'],
            [
                'description' => 'Kategori untuk publikasi agenda, dokumentasi acara, dan aktivitas organisasi HIMSI.',
                'active' => true,
            ]
        );

        $activityBlogs = [
            [
                'title' => 'Workshop & Seminar Nasional Web Development HIMSI 2025',
                'thumbnail' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&q=80',
                'quotes' => 'Membangun talenta digital masa depan melalui keahlian rekayasa web modern.',
                'body' => ['Pelaksanaan Workshop dan Seminar Nasional Web Development yang diselenggarakan oleh HIMSI UBSI dengan antusiasme tinggi dari para peserta.'],
                'images' => [
                    [
                        'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&q=80',
                        'description' => 'Sesi utama Seminar Nasional Web Development HIMSI UBSI.',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=1200&q=80',
                        'description' => 'Pelatihan hands-on coding aplikasi web bersama mentor industri.',
                    ],
                ],
            ],
            [
                'title' => 'Latihan Keterampilan Manajemen Mahasiswa (LKMM) HIMSI',
                'thumbnail' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80',
                'quotes' => 'Membentuk karakter kepemimpinan dan manajemen organisasi mahasiswa yang berintegritas.',
                'body' => ['Kegiatan LKMM HIMSI untuk membentuk jiwa kepemimpinan pengurus baru dalam menjalankan roda organisasi.'],
                'images' => [
                    [
                        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80',
                        'description' => 'Diskusi kelompok dan pemecahan studi kasus manajemen organisasi.',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=1200&q=80',
                        'description' => 'Sesi presentasi hasil proyek kepemimpinan peserta LKMM.',
                    ],
                ],
            ],
            [
                'title' => 'HIMSI Tech Week 2025: Hackathon & Software Expo',
                'thumbnail' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1200&q=80',
                'quotes' => 'Ajang kompetisi inovasi perangkat lunak terbesar mahasiswa Sistem Informasi.',
                'body' => ['Pameran dan kompetisi pengembangan software inovatif dalam rangkaian HIMSI Tech Week.'],
                'images' => [
                    [
                        'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=1200&q=80',
                        'description' => 'Pameran karya produk digital mahasiswa Sistem Informasi UBSI.',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1200&q=80',
                        'description' => 'Momen penganugerahan pemenang Hackathon HIMSI Tech Week.',
                    ],
                ],
            ],
            [
                'title' => 'Kunjungan Industri IT & Studi Banding HIMSI UBSI',
                'thumbnail' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&q=80',
                'quotes' => 'Mendekatkan mahasiswa dengan iklim kerja dan teknologi terkini di dunia industri.',
                'body' => ['Kunjungan lapangan HIMSI UBSI ke perusahaan teknologi terkemuka untuk memahami budaya kerja IT.'],
                'images' => [
                    [
                        'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&q=80',
                        'description' => 'Sesi sharing teknologi bersama tim Software Engineer industri.',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=1200&q=80',
                        'description' => 'Foto bersama rombongan HIMSI UBSI di lokasi kunjungan industri.',
                    ],
                ],
            ],
        ];

        foreach ($activityBlogs as $actBlog) {
            $createdBlog = Blog::updateOrCreate(
                ['slug' => Str::slug($actBlog['title'])],
                [
                    'branch_id' => $branch->id,
                    'title' => $actBlog['title'],
                    'thumbnail' => $actBlog['thumbnail'],
                    'quotes' => $actBlog['quotes'],
                    'body' => collect($actBlog['body'])->map(fn (string $paragraph): string => "<p>{$paragraph}</p>")->implode("\n"),
                    'category_id' => $kegiatanCategory->id,
                    'active' => true,
                ],
            );

            if (!empty($actBlog['images'])) {
                foreach ($actBlog['images'] as $imgData) {
                    \App\Models\BlogImage::updateOrCreate(
                        [
                            'blog_id' => $createdBlog->id,
                            'image' => $imgData['image'],
                        ],
                        [
                            'description' => $imgData['description'],
                            'active' => true,
                        ]
                    );
                }
            }
        }
    }
}
