<x-layouts.public title="DAMARA · Asisten AI HIMSI UBSI">

    {{-- 1. Hero Section (Dark Blue Gradient, matches all public pages) --}}
    <section class="relative bg-gradient-to-br from-[#000c46] via-[#00145c] to-[#001b79] text-white pt-28 pb-20 sm:pt-32 sm:pb-24 lg:pt-36 lg:pb-28 border-b border-[#001b79] overflow-hidden isolate">

        {{-- SVG dot-grid pattern --}}
        <div class="absolute inset-0 -z-10 pointer-events-none overflow-hidden">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="ai-hero-pattern" width="32" height="32" patternUnits="userSpaceOnUse">
                        <circle cx="0" cy="0" r="1.2" fill="white" fill-opacity="0.12"/>
                        <circle cx="32" cy="0" r="1.2" fill="white" fill-opacity="0.12"/>
                        <circle cx="0" cy="32" r="1.2" fill="white" fill-opacity="0.12"/>
                        <circle cx="32" cy="32" r="1.2" fill="white" fill-opacity="0.12"/>
                        <line x1="0" y1="0" x2="32" y2="0" stroke="white" stroke-opacity="0.04" stroke-width="0.5"/>
                        <line x1="0" y1="0" x2="0" y2="32" stroke="white" stroke-opacity="0.04" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#ai-hero-pattern)"/>
            </svg>
        </div>

        {{-- Ambient glows --}}
        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-[#0453cd]/25 blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute -right-20 -bottom-20 h-72 w-72 rounded-full bg-[#356ee7]/25 blur-3xl -z-10 pointer-events-none"></div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-10 text-center sm:text-left">
                {{-- DAMARA Avatar --}}
                <div class="relative shrink-0">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full overflow-hidden border-4 border-amber-400/50 shadow-[0_0_32px_rgba(245,158,11,0.3)]">
                        <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA"
                             class="w-full h-full object-cover">
                    </div>
                    <span class="absolute -bottom-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-emerald-500 border-2 border-[#000c46] shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                    </span>
                </div>
                {{-- Text --}}
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-bold text-white border border-white/20 uppercase tracking-wider backdrop-blur-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Asisten Virtual 24/7</span>
                    </div>
                    <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl lg:text-6xl">
                        Halo, aku <span class="text-amber-400">DAMARA</span>!
                    </h1>
                    <p class="text-base text-slate-200 sm:text-lg max-w-2xl leading-relaxed">
                        Asisten AI resmi HIMSI UBSI. Tanya aku seputar struktur organisasi, kegiatan, pendaftaran anggota, hingga info cabang DPC — kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. Chat Interface Section --}}
    <div x-data="aiChatPage(@js($greeting))" class="relative z-20 -mt-10 sm:-mt-14 pb-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            
            {{-- Unified Chat Card Container --}}
            <div class="bg-white rounded-3xl shadow-[0_16px_48px_rgba(0,12,70,0.12)] border border-slate-200/90 flex flex-col overflow-hidden" style="height: 640px;">

                {{-- Chat Card Header --}}
                <div class="px-5 py-3.5 bg-gradient-to-r from-slate-50 to-white border-b border-slate-200 flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="relative shrink-0">
                            <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA"
                                 class="w-10 h-10 rounded-xl object-cover bg-slate-50 shadow-sm border border-slate-200">
                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-bold text-sm text-[#000c46]">DAMARA</h3>
                                <span class="text-[9px] uppercase font-extrabold px-1.5 py-0.5 rounded bg-blue-100 text-[#0453cd]">ONLINE</span>
                            </div>
                            <p class="text-[11px] text-slate-500 font-medium">Didukung basis data resmi HIMSI UBSI</p>
                        </div>
                    </div>

                    <button type="button"
                            @click="resetChat()"
                            :disabled="messages.length <= 1 || loading"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-600 hover:text-[#ba1a1a] hover:border-red-200 hover:bg-red-50 disabled:opacity-40 disabled:cursor-not-allowed transition-all shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span>Mulai Ulang</span>
                    </button>
                </div>

                {{-- Scrollable Messages Area (Strictly Internal Scroll, No Page Jump) --}}
                <div x-ref="messagesContainer" class="flex-1 overflow-y-auto px-4 sm:px-6 py-4 space-y-4 bg-[#f9f9fc] scroll-smooth" style="scrollbar-width: thin;">

                    {{-- Empty State Welcome Banner (Saat baru buka) --}}
                    <div x-show="messages.length <= 1" class="py-6 text-center space-y-5">
                        <div class="inline-flex items-center justify-center p-2 bg-gradient-to-b from-blue-50 to-white rounded-2xl shadow-md border border-blue-100/60 mx-auto">
                            <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA"
                                 class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl object-cover">
                        </div>
                        <div class="space-y-1.5 max-w-md mx-auto">
                            <h2 class="text-lg sm:text-xl font-extrabold text-[#000c46]">Ada yang ingin Anda tanyakan?</h2>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Klik salah satu pertanyaan cepat di bawah atau ketik langsung pertanyaan Anda.
                            </p>
                        </div>

                        {{-- Quick Prompt Suggestions Grid --}}
                        <div class="pt-2 max-w-xl mx-auto">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-left">
                                <button type="button"
                                        @click="askPreset('Apa saja cabang dan sektor DPC HIMSI UBSI?')"
                                        class="group p-3 rounded-xl border border-slate-200/90 bg-white hover:border-[#0453cd] hover:bg-blue-50/50 transition-all shadow-xs flex items-start gap-2.5 text-left">
                                    <span class="text-base p-1 rounded-lg bg-blue-50 group-hover:bg-blue-100 transition-colors shrink-0">🏛️</span>
                                    <div>
                                        <p class="text-xs font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors">Cabang & Sektor DPC</p>
                                        <p class="text-[11px] text-slate-500 line-clamp-1">Lokasi DPC di wilayah UBSI</p>
                                    </div>
                                </button>

                                <button type="button"
                                        @click="askPreset('Bagaimana alur dan syarat pendaftaran rekrutmen pengurus HIMSI?')"
                                        class="group p-3 rounded-xl border border-slate-200/90 bg-white hover:border-[#0453cd] hover:bg-blue-50/50 transition-all shadow-xs flex items-start gap-2.5 text-left">
                                    <span class="text-base p-1 rounded-lg bg-amber-50 group-hover:bg-amber-100 transition-colors shrink-0">📋</span>
                                    <div>
                                        <p class="text-xs font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors">Rekrutmen Anggota</p>
                                        <p class="text-[11px] text-slate-500 line-clamp-1">Syarat & link pendaftaran</p>
                                    </div>
                                </button>

                                <button type="button"
                                        @click="askPreset('Apa saja divisi yang ada di HIMSI UBSI dan apa tugasnya?')"
                                        class="group p-3 rounded-xl border border-slate-200/90 bg-white hover:border-[#0453cd] hover:bg-blue-50/50 transition-all shadow-xs flex items-start gap-2.5 text-left">
                                    <span class="text-base p-1 rounded-lg bg-emerald-50 group-hover:bg-emerald-100 transition-colors shrink-0">💼</span>
                                    <div>
                                        <p class="text-xs font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors">Divisi Organisasi</p>
                                        <p class="text-[11px] text-slate-500 line-clamp-1">Peran & tugas tiap divisi</p>
                                    </div>
                                </button>

                                <button type="button"
                                        @click="askPreset('Bagaimana cara menghubungi HIMSI UBSI?')"
                                        class="group p-3 rounded-xl border border-slate-200/90 bg-white hover:border-[#0453cd] hover:bg-blue-50/50 transition-all shadow-xs flex items-start gap-2.5 text-left">
                                    <span class="text-base p-1 rounded-lg bg-purple-50 group-hover:bg-purple-100 transition-colors shrink-0">📬</span>
                                    <div>
                                        <p class="text-xs font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors">Kontak HIMSI</p>
                                        <p class="text-[11px] text-slate-500 line-clamp-1">Email & media sosial resmi</p>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Messages List --}}
                    <template x-for="(msg, i) in messages" :key="i">
                        <div class="flex items-start gap-2.5"
                             :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">

                            {{-- Assistant Avatar --}}
                            <div x-show="msg.role === 'assistant'" class="shrink-0 pt-0.5">
                                <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA"
                                     class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg object-cover bg-white shadow-2xs border border-slate-200">
                            </div>

                            {{-- Message Bubble --}}
                            <div x-html="renderMessage(msg)"
                                 :class="msg.role === 'user'
                                    ? 'bg-[#001b79] text-white rounded-2xl rounded-tr-xs px-4 py-2.5 max-w-[85%] sm:max-w-[75%] text-xs sm:text-sm leading-relaxed shadow-sm break-words'
                                    : 'bg-white border border-slate-200 text-[#1a1c1e] rounded-2xl rounded-tl-xs px-4 py-3 max-w-[92%] sm:max-w-[85%] text-xs sm:text-sm leading-relaxed shadow-xs break-words'">
                            </div>
                        </div>
                    </template>

                    {{-- Loading Indicator --}}
                    <div x-show="loading" class="flex items-start gap-2.5 justify-start">
                        <div class="shrink-0 pt-0.5">
                            <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA"
                                 class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg object-cover bg-white shadow-2xs border border-slate-200 animate-pulse">
                        </div>
                        <div class="bg-white border border-slate-200 rounded-2xl rounded-tl-xs px-3.5 py-2.5 shadow-xs">
                            <div class="flex gap-1.5 items-center h-4">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd] animate-bounce" style="animation-delay: 0ms"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd] animate-bounce" style="animation-delay: 150ms"></span>
                                <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd] animate-bounce" style="animation-delay: 300ms"></span>
                                <span class="text-xs text-slate-400 ml-1.5 font-medium">Menyiapkan jawaban...</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Pinned Bottom Input Form --}}
                <div class="p-3 sm:p-4 bg-white border-t border-slate-200 shrink-0">
                    <form @submit.prevent="send()" class="flex items-end gap-2">
                        <textarea
                            x-ref="inputField"
                            x-model="input"
                            @keydown="onKeydown($event)"
                            :disabled="loading"
                            rows="1"
                            placeholder="Tanyakan sesuatu seputar HIMSI UBSI... (Tekan Enter untuk kirim)"
                            class="flex-1 resize-none rounded-xl border border-slate-300 bg-slate-50/70 px-3.5 py-2.5 text-xs sm:text-sm text-[#1a1c1e] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0453cd]/30 focus:border-[#0453cd] focus:bg-white transition disabled:opacity-50 leading-relaxed"
                            style="max-height: 100px;"
                            @input="$el.style.height = 'auto'; $el.style.height = Math.min($el.scrollHeight, 100) + 'px'"
                        ></textarea>

                        <button
                            type="submit"
                            :disabled="loading || !input.trim()"
                            class="h-10 px-4 rounded-xl bg-gradient-to-r from-[#001b79] to-[#0453cd] text-white text-xs sm:text-sm font-bold flex items-center gap-1.5 hover:opacity-95 disabled:opacity-40 disabled:cursor-not-allowed transition-all shadow-sm shrink-0">
                            <span>Kirim</span>
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.876L5.999 12zm0 0h7.5"/>
                            </svg>
                        </button>
                    </form>
                    <p class="text-[11px] text-center text-slate-400 mt-2 select-none tracking-wide">
                        Powered by <span class="font-semibold text-slate-600">{{ $model ?? 'llama-3.3-70b-versatile' }}</span> · &copy; {{ date('Y') }} HIMSI UBSI
                    </p>
                </div>

            </div>

        </div>
    </div>

    <script>
        (function () {
            if (!window.copyCodeSnippet) {
                window.copyCodeSnippet = function (btn) {
                    const wrapper = btn.closest('.code-block-wrapper');
                    if (!wrapper) return;
                    const code = wrapper.querySelector('code');
                    if (!code) return;
                    const text = code.innerText || code.textContent;
                    navigator.clipboard.writeText(text).then(() => {
                        const originalHtml = btn.innerHTML;
                        btn.innerHTML = '<span class="text-emerald-400 font-semibold flex items-center gap-1">Tersalin! ✓</span>';
                        setTimeout(() => { btn.innerHTML = originalHtml; }, 2000);
                    }).catch(() => {});
                };
            }

            function registerAiChatPageComponent() {
                if (typeof Alpine !== 'undefined' && Alpine.data) {
                    Alpine.data('aiChatPage', (initialGreeting = '') => ({
                        messages: [],
                        input: '',
                        loading: false,
                        sessionId: null,
                        greeting: initialGreeting || 'Halo! Ada yang bisa saya bantu seputar HIMSI UBSI?',

                        init() {
                            // User is actively visiting the AI page, ensure the home announcement modal will not pop up again
                            try {
                                localStorage.setItem('himsi_ai_modal_dismissed', 'true');
                                sessionStorage.setItem('himsi_ai_modal_dismissed', 'true');
                                document.cookie = 'himsi_ai_modal_dismissed=true; path=/; max-age=31536000; SameSite=Lax';
                            } catch (e) {}

                            let sid = sessionStorage.getItem('himsi_ai_sid');
                            if (!sid) {
                                sid = (typeof crypto !== 'undefined' && crypto.randomUUID)
                                    ? crypto.randomUUID()
                                    : 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
                                        const r = Math.random() * 16 | 0;
                                        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                                    });
                                sessionStorage.setItem('himsi_ai_sid', sid);
                            }
                            this.sessionId = sid;
                            this.messages = [{ role: 'assistant', content: this.greeting }];

                            try {
                                const urlParams = new URLSearchParams(window.location.search);
                                const qParam = urlParams.get('q');
                                if (qParam && qParam.trim()) {
                                    this.$nextTick(() => {
                                        this.askPreset(qParam.trim());
                                    });
                                }
                            } catch (e) {}
                        },

                        resetChat() {
                            if (confirm('Mulai obrolan baru dan bersihkan riwayat pesan?')) {
                                this.messages = [{ role: 'assistant', content: this.greeting }];
                                this.input = '';
                                if (this.$refs.inputField) {
                                    this.$refs.inputField.style.height = 'auto';
                                    this.$refs.inputField.focus();
                                }
                            }
                        },

                        askPreset(text) {
                            this.input = text;
                            this.send();
                        },

                        scrollInternalBottom() {
                            const el = this.$refs.messagesContainer;
                            if (el) {
                                el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' });
                            }
                        },

                        async send() {
                            const q = this.input.trim();
                            if (!q || this.loading) return;

                            this.input = '';
                            if (this.$refs.inputField) {
                                this.$refs.inputField.style.height = 'auto';
                            }

                            this.messages.push({ role: 'user', content: q });
                            this.loading = true;
                            this.$nextTick(() => this.scrollInternalBottom());

                            try {
                                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                                const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

                                const res = await fetch('/ai/chat', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                    },
                                    body: JSON.stringify({
                                        question: q,
                                        session_id: this.sessionId,
                                        history: this.messages.slice(-10),
                                    }),
                                });

                                const data = await res.json();
                                this.messages.push({
                                    role: 'assistant',
                                    content: data.answer || 'Maaf, tidak ada tanggapan yang diterima.'
                                });
                            } catch (err) {
                                this.messages.push({
                                    role: 'assistant',
                                    content: 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.'
                                });
                            } finally {
                                this.loading = false;
                                this.$nextTick(() => this.scrollInternalBottom());
                            }
                        },

                        onKeydown(e) {
                            if (e.key === 'Enter' && !e.shiftKey) {
                                e.preventDefault();
                                this.send();
                            }
                        },

                        escapeHtml(str) {
                            return (str || '')
                                .replace(/&/g, '&amp;')
                                .replace(/</g, '&lt;')
                                .replace(/>/g, '&gt;')
                                .replace(/"/g, '&quot;')
                                .replace(/'/g, '&#039;');
                        },

                        renderMessage(msg) {
                            if (msg.role === 'assistant') {
                                return this.renderMarkdown(msg.content);
                            }
                            return this.escapeHtml(msg.content).replace(/\n/g, '<br>');
                        },

                        renderMarkdown(text) {
                            if (!text) return '';

                            let safe = this.escapeHtml(text);

                            // Markdown links [text](url)
                            safe = safe.replace(/\[([^\]]+)\]\((https?:\/\/[^\s)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer" class="text-[#0453cd] underline underline-offset-2 hover:text-[#001b79] font-semibold break-all inline-flex items-center gap-1">$1 <svg class="w-3 h-3 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>');

                            // Autolink raw URLs
                            safe = safe.replace(/(^|[^">])(https?:\/\/[^\s<)]+)/g, '$1<a href="$2" target="_blank" rel="noopener noreferrer" class="text-[#0453cd] underline underline-offset-2 hover:text-[#001b79] font-semibold break-all inline-flex items-center gap-1">$2 <svg class="w-3 h-3 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>');

                            const inline = s => s
                                .replace(/\*\*\*(.*?)\*\*\*/g, '<strong class="font-bold text-[#000c46]"><em class="italic">$1</em></strong>')
                                .replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-[#000c46]">$1</strong>')
                                .replace(/~~(.*?)~~/g, '<del class="line-through text-slate-400">$1</del>')
                                .replace(/\*(.*?)\*/g, '<em class="italic">$1</em>')
                                .replace(/`(.*?)`/g, '<code class="bg-slate-100 px-1.5 py-0.5 rounded text-xs font-mono text-[#001b79] border border-slate-200">$1</code>');

                            const isTableDelimiter = l => {
                                if (!l) return false;
                                let t = l.trim();
                                if (!t) return false;
                                if (t.startsWith('|')) t = t.substring(1);
                                if (t.endsWith('|')) t = t.substring(0, t.length - 1);
                                const segments = t.split('|').map(s => s.trim());
                                if (segments.length < 2) return false;
                                return segments.every(s => /^:?-+:?$/.test(s));
                            };

                            const parseCells = l => {
                                let t = l.trim().replace(/\\\|/g, '\uE000');
                                if (t.startsWith('|')) t = t.substring(1);
                                if (t.endsWith('|')) t = t.substring(0, t.length - 1);
                                return t.split('|').map(s => s.replace(/\uE000/g, '|').trim());
                            };

                            const renderTable = tLines => {
                                if (tLines.length < 2) return '';
                                const headerCells = parseCells(tLines[0]);
                                const delimiterCells = parseCells(tLines[1]);
                                const bodyLines = tLines.slice(2);

                                const alignments = delimiterCells.map(cell => {
                                    const left = cell.startsWith(':');
                                    const right = cell.endsWith(':');
                                    if (left && right) return 'text-center';
                                    if (right) return 'text-right';
                                    return 'text-left';
                                });

                                const thead = '<thead><tr class="bg-[#f0f4ff] border-b border-slate-200 text-[#000c46]">' +
                                    headerCells.map((cell, idx) => {
                                        const align = alignments[idx] || 'text-left';
                                        return `<th class="py-2.5 px-3.5 font-bold text-xs ${align} whitespace-nowrap">${inline(cell)}</th>`;
                                    }).join('') +
                                    '</tr></thead>';

                                const tbody = '<tbody class="divide-y divide-slate-100">' +
                                    bodyLines.map((rowLine, rIdx) => {
                                        const cells = parseCells(rowLine);
                                        const bg = rIdx % 2 === 1 ? 'bg-slate-50/50' : 'bg-white';
                                        const tds = cells.map((cell, idx) => {
                                            const align = alignments[idx] || 'text-left';
                                            return `<td class="py-2 px-3.5 text-[#1a1c1e] text-xs sm:text-[13px] ${align} leading-relaxed">${inline(cell)}</td>`;
                                        }).join('');
                                        return `<tr class="${bg} hover:bg-blue-50/40 transition-colors">${tds}</tr>`;
                                    }).join('') +
                                    '</tbody>';

                                return '<div class="my-3 overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-2xs"><table class="min-w-full text-left border-collapse text-xs">' + thead + tbody + '</table></div>';
                            };

                            const lines = safe.split('\n');
                            const parts = [];
                            let listItems = [];
                            let currentListType = null; // 'ul' | 'ol'

                            const flushList = () => {
                                if (listItems.length) {
                                    if (currentListType === 'ol') {
                                        parts.push('<ol class="list-decimal pl-5 my-2 space-y-1">' + listItems.join('') + '</ol>');
                                    } else {
                                        parts.push('<ul class="list-disc pl-5 my-2 space-y-1">' + listItems.join('') + '</ul>');
                                    }
                                    listItems = [];
                                    currentListType = null;
                                }
                            };

                            let i = 0;
                            while (i < lines.length) {
                                const line = lines[i];
                                const nextLine = i + 1 < lines.length ? lines[i + 1] : null;

                                // Code block (```) with Copy button
                                if (line.trim().startsWith('```')) {
                                    flushList();
                                    const lang = line.trim().slice(3).trim();
                                    i++;
                                    const codeLines = [];
                                    while (i < lines.length && !lines[i].trim().startsWith('```')) {
                                        codeLines.push(lines[i]);
                                        i++;
                                    }
                                    i++; // skip closing ```
                                    parts.push(
                                        '<div class="code-block-wrapper my-2.5 rounded-xl overflow-hidden border border-slate-700 bg-slate-900 shadow-xs">' +
                                            '<div class="flex items-center justify-between px-3.5 py-1.5 bg-slate-800 text-slate-400 text-[11px] font-mono border-b border-slate-700/80 select-none">' +
                                                '<span class="text-slate-300 font-semibold lowercase">' + (lang || 'code') + '</span>' +
                                                '<button type="button" onclick="window.copyCodeSnippet(this)" class="hover:text-white transition-colors cursor-pointer inline-flex items-center gap-1 px-2 py-0.5 rounded hover:bg-slate-700">' +
                                                    '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>' +
                                                    '<span>Salin</span>' +
                                                '</button>' +
                                            '</div>' +
                                            '<pre class="p-3 text-slate-100 text-xs font-mono overflow-x-auto leading-relaxed"><code>' + codeLines.join('\n') + '</code></pre>' +
                                        '</div>'
                                    );
                                    continue;
                                }

                                // Table block
                                if (line.includes('|') && nextLine && isTableDelimiter(nextLine)) {
                                    flushList();
                                    const tableLines = [line, nextLine];
                                    i += 2;
                                    while (i < lines.length && lines[i].includes('|') && lines[i].trim() !== '') {
                                        tableLines.push(lines[i]);
                                        i++;
                                    }
                                    parts.push(renderTable(tableLines));
                                    continue;
                                }

                                // Blockquote (> quote)
                                const quoteMatch = line.match(/^(&gt;|>)\s?(.*)$/);
                                if (quoteMatch) {
                                    flushList();
                                    const quoteLines = [quoteMatch[2]];
                                    i++;
                                    while (i < lines.length) {
                                        const nextQuote = lines[i].match(/^(&gt;|>)\s?(.*)$/);
                                        if (nextQuote) {
                                            quoteLines.push(nextQuote[2]);
                                            i++;
                                        } else {
                                            break;
                                        }
                                    }
                                    const quoteContent = quoteLines.map(ql => inline(ql)).join('<br>');
                                    parts.push('<blockquote class="border-l-4 border-[#0453cd] bg-blue-50/60 pl-3.5 pr-3 py-2 my-2.5 rounded-r-xl text-xs sm:text-[13px] text-slate-700 leading-relaxed shadow-2xs">' + quoteContent + '</blockquote>');
                                    continue;
                                }

                                // Horizontal Rule
                                if (/^(\*{3,}|-{3,}|_{3,})$/.test(line.trim())) {
                                    flushList();
                                    parts.push('<hr class="my-3 border-t border-slate-200">');
                                    i++;
                                    continue;
                                }

                                // Headings with hierarchy (#, ##, ###)
                                const heading = line.match(/^(#{1,3})\s+(.+)$/);
                                if (heading) {
                                    flushList();
                                    const level = heading[1].length;
                                    const hText = inline(heading[2]);
                                    if (level === 1) {
                                        parts.push('<h4 class="font-extrabold text-sm sm:text-base mt-3 mb-1.5 text-[#000c46] tracking-tight">' + hText + '</h4>');
                                    } else if (level === 2) {
                                        parts.push('<h5 class="font-bold text-xs sm:text-sm mt-2.5 mb-1 text-[#000c46]">' + hText + '</h5>');
                                    } else {
                                        parts.push('<h6 class="font-bold text-xs mt-2 mb-0.5 text-[#0453cd] tracking-wide uppercase">' + hText + '</h6>');
                                    }
                                    i++;
                                    continue;
                                }

                                // Task list: - [ ] or - [x]
                                const task = line.match(/^[-*•]\s+\[([ xX])\]\s+(.+)$/);
                                const bullet = line.match(/^[-*•]\s+(.+)$/);
                                const numbered = line.match(/^(\d+)\.\s+(.+)$/);

                                if (task) {
                                    if (currentListType === 'ol') flushList();
                                    currentListType = 'ul';
                                    const checked = task[1].toLowerCase() === 'x';
                                    const checkBadge = checked
                                        ? '<span class="inline-flex items-center justify-center w-4 h-4 rounded bg-emerald-100 text-emerald-700 text-xs font-bold shrink-0">✓</span>'
                                        : '<span class="inline-flex items-center justify-center w-4 h-4 rounded border border-slate-300 bg-white text-transparent text-xs shrink-0">○</span>';
                                    listItems.push('<li class="flex items-start gap-2 list-none -ml-5 my-1 leading-relaxed">' + checkBadge + '<span>' + inline(task[2]) + '</span></li>');
                                } else if (bullet) {
                                    if (currentListType === 'ol') flushList();
                                    currentListType = 'ul';
                                    listItems.push('<li class="leading-relaxed">' + inline(bullet[1]) + '</li>');
                                } else if (numbered) {
                                    if (currentListType === 'ul') flushList();
                                    currentListType = 'ol';
                                    listItems.push('<li class="leading-relaxed">' + inline(numbered[2]) + '</li>');
                                } else {
                                    flushList();
                                    if (line.trim() === '') {
                                        parts.push('<div class="h-2"></div>');
                                    } else {
                                        parts.push('<p class="my-1 leading-relaxed">' + inline(line) + '</p>');
                                    }
                                }
                                i++;
                            }
                            flushList();
                            return parts.join('');
                        }
                    }));
                }
            }

            if (window.Alpine) {
                registerAiChatPageComponent();
            } else {
                document.addEventListener('alpine:init', registerAiChatPageComponent);
            }
        })();
    </script>
</x-layouts.public>
