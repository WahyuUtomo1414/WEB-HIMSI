<div class="card-nexus rounded-3xl p-8 md:p-10 bg-white space-y-6">
    <div>
        <h3 class="text-2xl font-bold text-[#000c46]">Kirim Pesan Ke HIMSI</h3>
        <p class="text-sm text-[#454652] mt-1">Silakan isi formulir di bawah ini untuk mengirimkan pesan, pertanyaan, atau usulan kerjasama.</p>
    </div>

    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#454652] mb-1.5">Nama Lengkap</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Masukkan nama lengkap Anda" 
                   required 
                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
            @error('name')
                <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#454652] mb-1.5">Alamat Email</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="nama@email.com" 
                   required 
                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
            @error('email')
                <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-[#454652] mb-1.5">Subjek Pesan</label>
            <input type="text" 
                   id="subject" 
                   name="subject" 
                   value="{{ old('subject') }}" 
                   placeholder="Topik atau subjek pesan Anda" 
                   required 
                   class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">
            @error('subject')
                <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#454652] mb-1.5">Isi Pesan</label>
            <textarea id="message" 
                      name="message" 
                      rows="5" 
                      placeholder="Tuliskan pesan lengkap Anda di sini..." 
                      required 
                      class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-[#001b79] focus:bg-white focus:outline-none">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full rounded-xl bg-[#001b79] px-6 py-3.5 text-base font-bold text-white transition hover:bg-[#000c46] shadow-md hover:shadow-lg">
                Kirim Pesan Sekarang
            </button>
        </div>
    </form>
</div>
