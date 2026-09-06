<x-layouts.public title="Asisten AI HIMSI - HIMSI UBSI">

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

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-bold text-white border border-white/20 uppercase tracking-wider backdrop-blur-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Asisten Virtual 24/7</span>
            </div>
            <h1 class="text-4xl font-extrabold text-white tracking-tight sm:text-5xl lg:text-6xl">
                Tanya Asisten AI HIMSI
            </h1>
            <p class="text-base text-slate-200 sm:text-lg max-w-2xl mx-auto leading-relaxed">
                Dapatkan informasi resmi seputar struktur organisasi, kegiatan, pendaftaran anggota baru, hingga cabang DPC secara instan.
            </p>
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
                            <img src="{{ asset('images/ai-robot.jpg') }}" alt="Robot Asisten AI"
                                 class="w-10 h-10 rounded-xl object-cover shadow-sm border border-slate-200">
                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-bold text-sm text-[#000c46]">Asisten Pintar HIMSI</h3>
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
                        <div class="inline-flex items-center justify-center p-2.5 bg-white rounded-2xl shadow-md border border-blue-100/60 mx-auto">
                            <img src="{{ asset('images/ai-robot.jpg') }}" alt="Robot HIMSI"
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
                                        @click="askPreset('Bisa minta link grup WhatsApp resmi cabang HIMSI?')"
                                        class="group p-3 rounded-xl border border-slate-200/90 bg-white hover:border-[#0453cd] hover:bg-blue-50/50 transition-all shadow-xs flex items-start gap-2.5 text-left">
                                    <span class="text-base p-1 rounded-lg bg-purple-50 group-hover:bg-purple-100 transition-colors shrink-0">💬</span>
                                    <div>
                                        <p class="text-xs font-bold text-[#000c46] group-hover:text-[#0453cd] transition-colors">Grup WhatsApp</p>
                                        <p class="text-[11px] text-slate-500 line-clamp-1">Tautan grup resmi cabang</p>
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
                                <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-[#001b79] to-[#0453cd] flex items-center justify-center text-white shadow-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                                    </svg>
                                </div>
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
                            <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-[#001b79] to-[#0453cd] flex items-center justify-center text-white shadow-xs animate-pulse">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                                </svg>
                            </div>
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
                    <div class="mt-2.5 flex flex-wrap items-center justify-center gap-2 text-[11px] text-slate-500 font-medium select-none">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-100 border border-slate-200/80 text-slate-700 shadow-2xs font-semibold">
                            <span class="relative flex h-1.5 w-1.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-80"></span>
                                <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                            </span>
                            <svg class="w-3 h-3 text-[#0453cd]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                            </svg>
                            <span>HIMSI Neural AI Engine</span>
                        </span>
                        <span class="text-slate-300 hidden sm:inline">·</span>
                        <span class="inline-flex items-center gap-1 text-slate-400 text-[10.5px]">
                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Disinkronkan dengan Basis Data & AD/ART Resmi HIMSI UBSI</span>
                        </span>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        (function () {
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
                                .replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-[#000c46]">$1</strong>')
                                .replace(/\*(.*?)\*/g, '<em class="italic">$1</em>')
                                .replace(/`(.*?)`/g, '<code class="bg-slate-100 px-1.5 py-0.5 rounded text-xs font-mono text-[#001b79] border border-slate-200">$1</code>');

                            const lines = safe.split('\n');
                            const parts = [];
                            let listItems = [];

                            const flushList = () => {
                                if (listItems.length) {
                                    parts.push('<ul class="list-disc pl-5 my-2 space-y-1">' + listItems.join('') + '</ul>');
                                    listItems = [];
                                }
                            };

                            for (const line of lines) {
                                const bullet = line.match(/^[-*•]\s+(.+)$/);
                                const numbered = line.match(/^(\d+)\.\s+(.+)$/);
                                const heading = line.match(/^#{1,3}\s+(.+)$/);

                                if (bullet) {
                                    listItems.push('<li class="leading-relaxed">' + inline(bullet[1]) + '</li>');
                                } else if (numbered) {
                                    listItems.push('<li class="leading-relaxed">' + inline(numbered[2]) + '</li>');
                                } else {
                                    flushList();
                                    if (line.trim() === '') {
                                        parts.push('<div class="h-2"></div>');
                                    } else if (heading) {
                                        parts.push('<p class="font-black text-sm my-1.5 text-[#000c46]">' + inline(heading[1]) + '</p>');
                                    } else {
                                        parts.push('<p class="my-1 leading-relaxed">' + inline(line) + '</p>');
                                    }
                                }
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
