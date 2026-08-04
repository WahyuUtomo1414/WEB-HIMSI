Siapkan CI/CD untuk auto deploy website ini ke hosting

- siapkan folder github ci/cd isinya konek ke ssh kemudian jalanin deploy.sh
- siapkan folder deployment di dalam nya ada env dan deploy.sh yang menjalankan command linux 
    - cd ke direktori tujuan
    - git pull origin {nama branch}
    - sisanya jalankan standart deployment laravel
- konfigurasi di env ada
    - direktori tujuan 
    - nama branch 
    - ssh host 
    - ssh port 
    - ssh user
    - ssh private key
- siap kan juga untuk sync secret dan variables github untuk kebutuhan env ci/cd nya beri nama aja sync.sh
