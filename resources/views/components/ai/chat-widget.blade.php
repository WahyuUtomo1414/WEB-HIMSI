@props(['greeting' => 'Halo! Ada yang bisa saya bantu seputar HIMSI?'])

<div x-data="{
        open: false,
        messages: [],
        input: '',
        loading: false,
        sessionId: null,
        greeting: @js($greeting),

        init() {
            let sid = sessionStorage.getItem('himsi_ai_sid');
            if (!sid) {
                sid = crypto.randomUUID
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

        toggle() {
            this.open = !this.open;
            if (this.open) {
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async send() {
            const q = this.input.trim();
            if (!q || this.loading) return;

            this.input = '';
            this.messages.push({ role: 'user', content: q });
            this.loading = true;
            this.$nextTick(() => this.scrollToBottom());

            try {
                const res = await fetch('/ai/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                    body: JSON.stringify({
                        question: q,
                        session_id: this.sessionId,
                        history: this.messages.slice(-10),
                    }),
                });

                const data = await res.json();
                this.messages.push({ role: 'assistant', content: data.answer });
            } catch {
                this.messages.push({ role: 'assistant', content: 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.' });
            } finally {
                this.loading = false;
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        onKeydown(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.send();
            }
        },

        scrollToBottom() {
            const el = this.$refs.messages;
            if (el) el.scrollTop = el.scrollHeight;
        },

        renderMarkdown(text) {
            const esc = s => s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            const inline = s => s
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/`(.*?)`/g, '<code style="background:#f1f5f9;padding:1px 4px;border-radius:3px;font-size:11px;font-family:monospace">$1</code>');

            const lines = esc(text).split('\n');
            const parts = [];
            let listItems = [];

            const flushList = () => {
                if (listItems.length) {
                    parts.push('<ul style="list-style:disc;padding-left:1rem;margin:4px 0">' + listItems.join('') + '</ul>');
                    listItems = [];
                }
            };

            for (const line of lines) {
                const bullet = line.match(/^[-*] (.+)$/);
                const numbered = line.match(/^\d+\. (.+)$/);
                const heading = line.match(/^#{1,3} (.+)$/);
                if (bullet) {
                    listItems.push('<li>' + inline(bullet[1]) + '</li>');
                } else if (numbered) {
                    listItems.push('<li>' + inline(numbered[1]) + '</li>');
                } else {
                    flushList();
                    if (line.trim() === '') {
                        parts.push('<br>');
                    } else if (heading) {
                        parts.push('<p style="font-weight:700;margin:4px 0 2px">' + inline(heading[1]) + '</p>');
                    } else {
                        parts.push('<p style="margin:2px 0">' + inline(line) + '</p>');
                    }
                }
            }
            flushList();
            return parts.join('');
        }
    }"
    class="relative">

    {{-- Chat Panel --}}
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 scale-95"
         class="absolute bottom-[4.5rem] right-0 w-[360px] max-w-[calc(100vw-3rem)] rounded-2xl bg-white shadow-[0_8px_40px_rgba(0,27,121,0.18)] border border-[#c5c5d4]/60 flex flex-col overflow-hidden"
         style="height: 460px;">

        {{-- Header --}}
        <div class="flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-[#001b79] to-[#0453cd] shrink-0">
            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-white/20">
                <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-white leading-tight">Asisten HIMSI</p>
                <p class="text-[10px] text-white/70 leading-tight">AI · Siap membantu</p>
            </div>
            <button @click="toggle()" class="text-white/70 hover:text-white transition-colors" aria-label="Tutup">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Messages --}}
        <div x-ref="messages" class="flex-1 overflow-y-auto px-3 py-3 space-y-3 bg-[#f9f9fc]">
            <template x-for="(msg, i) in messages" :key="i">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div x-html="msg.role === 'assistant' ? renderMarkdown(msg.content) : msg.content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>')"
                         :class="msg.role === 'user'
                            ? 'bg-[#001b79] text-white rounded-2xl rounded-tr-sm px-3 py-2 max-w-[88%] text-xs leading-relaxed'
                            : 'bg-white border border-[#c5c5d4]/60 text-[#1a1c1e] rounded-2xl rounded-tl-sm px-3 py-2 max-w-[88%] text-xs leading-relaxed shadow-sm'">
                    </div>
                </div>
            </template>

            {{-- Loading indicator --}}
            <div x-show="loading" class="flex justify-start">
                <div class="bg-white border border-[#c5c5d4]/60 rounded-2xl rounded-tl-sm px-3 py-2 shadow-sm">
                    <div class="flex gap-1 items-center h-4">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd] animate-bounce" style="animation-delay: 0ms"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd] animate-bounce" style="animation-delay: 150ms"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-[#0453cd] animate-bounce" style="animation-delay: 300ms"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div class="flex items-end gap-2 px-3 py-3 border-t border-[#c5c5d4]/60 bg-white shrink-0">
            <textarea
                x-model="input"
                @keydown="onKeydown($event)"
                :disabled="loading"
                rows="1"
                placeholder="Ketik pertanyaanmu..."
                class="flex-1 resize-none rounded-xl border border-[#c5c5d4]/80 bg-[#f9f9fc] px-3 py-2 text-xs text-[#1a1c1e] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0453cd]/40 focus:border-[#0453cd] transition disabled:opacity-50 leading-relaxed"
                style="max-height: 80px;"
                @input="$el.style.height = 'auto'; $el.style.height = Math.min($el.scrollHeight, 80) + 'px'"
            ></textarea>
            <button
                @click="send()"
                :disabled="loading || !input.trim()"
                class="h-8 w-8 shrink-0 rounded-xl bg-[#001b79] text-white flex items-center justify-center hover:bg-[#0453cd] disabled:opacity-40 disabled:cursor-not-allowed transition-colors"
                aria-label="Kirim">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.876L5.999 12zm0 0h7.5"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- FAB Button --}}
    <button @click="toggle()"
            :class="open ? 'bg-[#0453cd] scale-110' : 'bg-[#001b79]'"
            class="relative h-16 w-16 rounded-full text-white flex items-center justify-center shadow-[0_4px_24px_rgba(0,27,121,0.4)] hover:bg-[#0453cd] hover:scale-110 transition-all duration-300 group"
            :aria-label="open ? 'Tutup chat' : 'Buka chat AI'"
            :title="open ? 'Tutup chat' : 'Tanya Asisten HIMSI'">

        {{-- Pulse ring saat belum pernah dibuka --}}
        <span x-show="messages.length <= 1 && !open"
              class="absolute inset-0 rounded-full bg-[#0453cd] animate-ping opacity-30"></span>

        {{-- Icon chat --}}
        <svg x-show="!open" class="h-7 w-7 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
        </svg>

        {{-- Icon X saat panel terbuka --}}
        <svg x-show="open" x-cloak class="h-6 w-6 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>

        {{-- Tooltip --}}
        <span x-show="!open"
              class="absolute right-20 whitespace-nowrap rounded-lg bg-[#000c46] px-3 py-1.5 text-xs font-semibold text-white shadow-md opacity-0 pointer-events-none transition-all duration-300 group-hover:opacity-100">
            Tanya Asisten HIMSI
        </span>
    </button>
</div>
