<div class="group relative rounded-3xl p-8 sm:p-10 bg-white border border-[#c5c5d4]/60 shadow-[0_4px_20px_rgba(0,27,121,0.04)] hover:shadow-[0_12px_32px_rgba(0,27,121,0.1)] transition-all duration-300 space-y-6 overflow-hidden">
    <!-- Top Gradient Accent Line -->
    <div class="h-1.5 w-full bg-gradient-to-r from-[#001b79] via-[#0453cd] to-[#356ee7] absolute top-0 left-0"></div>

    <div class="space-y-1">
        <h3 class="text-2xl font-extrabold text-[#000c46]">Kirim Pesan Ke HIMSI</h3>
        <p class="text-xs sm:text-sm text-[#454652]">Silakan isi formulir di bawah ini untuk mengirimkan pesan, pertanyaan, atau usulan kerjasama.</p>
    </div>



    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#000c46] mb-1.5">Nama Lengkap</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   placeholder="Masukkan nama lengkap Anda" 
                   required 
                   class="w-full rounded-2xl border border-[#c5c5d4]/60 bg-slate-50/70 px-4 py-3.5 text-sm font-semibold text-[#000c46] placeholder:text-slate-400 focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all shadow-xs">
            @error('name')
                <p class="text-xs text-red-600 mt-1.5 font-semibold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#000c46] mb-1.5">Alamat Email</label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   placeholder="nama@email.com" 
                   required 
                   class="w-full rounded-2xl border border-[#c5c5d4]/60 bg-slate-50/70 px-4 py-3.5 text-sm font-semibold text-[#000c46] placeholder:text-slate-400 focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all shadow-xs">
            @error('email')
                <p class="text-xs text-red-600 mt-1.5 font-semibold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div>
            <label for="subject" class="block text-xs font-bold uppercase tracking-wider text-[#000c46] mb-1.5">Subjek Pesan</label>
            <input type="text" 
                   id="subject" 
                   name="subject" 
                   value="{{ old('subject') }}" 
                   placeholder="Topik atau subjek pesan Anda" 
                   required 
                   class="w-full rounded-2xl border border-[#c5c5d4]/60 bg-slate-50/70 px-4 py-3.5 text-sm font-semibold text-[#000c46] placeholder:text-slate-400 focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all shadow-xs">
            @error('subject')
                <p class="text-xs text-red-600 mt-1.5 font-semibold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-xs font-bold uppercase tracking-wider text-[#000c46] mb-1.5">Isi Pesan</label>
            <textarea id="message" 
                      name="message" 
                      rows="5" 
                      placeholder="Tuliskan pesan lengkap Anda di sini..." 
                      required 
                      class="w-full rounded-2xl border border-[#c5c5d4]/60 bg-slate-50/70 px-4 py-3.5 text-sm font-semibold text-[#000c46] placeholder:text-slate-400 focus:border-[#0453cd] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0453cd]/20 transition-all shadow-xs">{{ old('message') }}</textarea>
            @error('message')
                <p class="text-xs text-red-600 mt-1.5 font-semibold flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span>{{ $message }}</span>
                </p>
            @enderror
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-[#001b79] to-[#0453cd] hover:from-[#000c46] hover:to-[#001b79] px-6 py-4 text-sm font-extrabold text-white transition-all duration-300 shadow-md hover:shadow-xl hover:scale-[1.01] flex items-center justify-center gap-2 group">
                <span>Kirim Pesan Sekarang</span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
            </button>
        </div>
    </form>
</div>
