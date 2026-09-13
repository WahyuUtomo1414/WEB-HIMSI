@props(['greeting' => 'Halo! Ada yang bisa saya bantu seputar HIMSI?'])

@php
    $greetingText = $greeting ?: 'Halo! Ada yang bisa saya bantu seputar HIMSI?';
@endphp

<div x-data="aiChatWidget(@js($greetingText))" class="relative" @click.outside="open = false">

    {{-- Chat Panel --}}
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 scale-95"
         class="absolute bottom-[4.75rem] right-0 w-[360px] sm:w-[380px] max-w-[calc(100vw-2.5rem)] rounded-2xl bg-white shadow-[0_12px_48px_rgba(0,27,121,0.2)] border border-[#c5c5d4]/60 flex flex-col overflow-hidden z-50"
         style="height: 480px; max-height: calc(100vh - 12rem);">

        {{-- Header --}}
        <div class="flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-[#001b79] to-[#0453cd] shrink-0">
            <div class="relative flex h-8 w-8 items-center justify-center rounded-full bg-white/20 overflow-hidden shrink-0">
                <img src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA" class="w-full h-full object-cover rounded-full">
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-white leading-tight">DAMARA</p>
                <p class="text-[10px] text-white/70 leading-tight">AI · Siap membantu</p>
            </div>
            <button type="button" @click="toggle()" class="text-white/70 hover:text-white transition-colors p-1" aria-label="Tutup">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Messages --}}
        <div x-ref="messages" class="flex-1 overflow-y-auto px-3.5 py-3 space-y-3 bg-[#f9f9fc] scroll-smooth" style="scrollbar-width: thin;">
            <template x-for="(msg, i) in messages" :key="i">
                <div class="chat-bubble-row" :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div x-html="renderMessage(msg)"
                         :class="msg.role === 'user'
                            ? 'bg-[#001b79] text-white rounded-2xl rounded-tr-sm px-3.5 py-2.5 max-w-[88%] text-xs leading-relaxed shadow-sm break-words'
                            : 'bg-white border border-[#c5c5d4]/60 text-[#1a1c1e] rounded-2xl rounded-tl-sm px-3.5 py-2.5 max-w-[88%] text-xs leading-relaxed shadow-sm break-words'">
                    </div>
                </div>
            </template>

            {{-- Loading indicator --}}
            <div x-show="loading" class="flex justify-start">
                <div class="bg-white border border-[#c5c5d4]/60 rounded-2xl rounded-tl-sm px-3.5 py-2.5 shadow-sm">
                    <div class="flex gap-1.5 items-center h-4">
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
                x-ref="inputField"
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
                type="button"
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
    <button type="button"
            @click="toggle()"
            class="relative h-16 w-16 rounded-full overflow-hidden text-white flex items-center justify-center shadow-[0_4px_24px_rgba(0,27,121,0.4)] hover:scale-110 transition-all duration-300 group border-2 border-white/30"
            :class="open ? 'scale-105 border-amber-400/60' : ''"
            :aria-label="open ? 'Tutup chat' : 'Buka chat AI'"
            :title="open ? 'Tutup chat' : 'Tanya DAMARA'">

        {{-- Pulse ring saat belum pernah dibuka --}}
        <span x-show="messages.length <= 1 && !open"
              class="absolute inset-0 rounded-full bg-[#0453cd] animate-ping opacity-30 pointer-events-none"></span>

        {{-- DAMARA avatar saat tertutup --}}
        <img x-show="!open" src="{{ asset('images/ai-ilustrator.png') }}" alt="DAMARA"
             class="absolute inset-0 w-full h-full object-cover rounded-full z-10">

        {{-- Icon X saat panel terbuka --}}
        <div x-show="open" x-cloak class="absolute inset-0 bg-[#001b79] flex items-center justify-center z-10">
            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>

        {{-- Tooltip --}}
        <span x-show="!open"
              class="absolute right-20 whitespace-nowrap rounded-lg bg-[#000c46] px-3 py-1.5 text-xs font-semibold text-white shadow-md opacity-0 pointer-events-none transition-all duration-300 group-hover:opacity-100 z-20">
            Tanya DAMARA
        </span>
    </button>
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

        function registerAiChatComponent() {
            if (typeof Alpine !== 'undefined' && Alpine.data) {
                Alpine.data('aiChatWidget', (initialGreeting = '') => ({
                    open: false,
                    messages: [],
                    input: '',
                    loading: false,
                    sessionId: null,
                    greeting: initialGreeting || 'Halo! Ada yang bisa saya bantu seputar HIMSI?',

                    init() {
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

                    toggle() {
                        this.open = !this.open;
                        if (this.open) {
                            this.$nextTick(() => {
                                this.scrollToBottom();
                                if (this.$refs.inputField) {
                                    this.$refs.inputField.focus();
                                }
                            });
                        }
                    },

                    async send() {
                        const q = this.input.trim();
                        if (!q || this.loading) return;

                        const userMsgIndex = this.messages.length;
                        this.input = '';
                        this.messages.push({ role: 'user', content: q });
                        this.loading = true;
                        this.$nextTick(() => this.scrollToBottom());

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

                            // Scroll smoothly to the user message row so both the question and the start of the answer are visible
                            this.$nextTick(() => {
                                const el = this.$refs.messages;
                                if (!el) return;
                                const rows = el.querySelectorAll('.chat-bubble-row');
                                if (rows && rows[userMsgIndex]) {
                                    rows[userMsgIndex].scrollIntoView({ behavior: 'smooth', block: 'start' });
                                } else {
                                    el.scrollTop = el.scrollHeight;
                                }
                            });
                        } catch (err) {
                            this.messages.push({
                                role: 'assistant',
                                content: 'Maaf, terjadi kesalahan koneksi. Silakan coba lagi.'
                            });
                            this.$nextTick(() => this.scrollToBottom());
                        } finally {
                            this.loading = false;
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

                        // Markdown links: [text](https://...)
                        safe = safe.replace(/\[([^\]]+)\]\((https?:\/\/[^\s)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer" class="text-[#0453cd] underline underline-offset-2 hover:text-[#001b79] font-medium break-all">$1</a>');

                        // Autolink raw URLs
                        safe = safe.replace(/(^|[^">])(https?:\/\/[^\s<)]+)/g, '$1<a href="$2" target="_blank" rel="noopener noreferrer" class="text-[#0453cd] underline underline-offset-2 hover:text-[#001b79] font-medium break-all">$2</a>');

                        const inline = s => s
                            .replace(/\*\*\*(.*?)\*\*\*/g, '<strong class="font-bold text-[#000c46]"><em class="italic">$1</em></strong>')
                            .replace(/\*\*(.*?)\*\*/g, '<strong class="font-semibold text-[#000c46]">$1</strong>')
                            .replace(/~~(.*?)~~/g, '<del class="line-through text-slate-400">$1</del>')
                            .replace(/\*(.*?)\*/g, '<em class="italic">$1</em>')
                            .replace(/`(.*?)`/g, '<code class="bg-slate-100 px-1 py-0.5 rounded text-[11px] font-mono text-[#001b79] border border-slate-200">$1</code>');

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
                                    return `<th class="py-2 px-2.5 font-bold text-[11px] ${align} whitespace-nowrap">${inline(cell)}</th>`;
                                }).join('') +
                                '</tr></thead>';

                            const tbody = '<tbody class="divide-y divide-slate-100">' +
                                bodyLines.map((rowLine, rIdx) => {
                                    const cells = parseCells(rowLine);
                                    const bg = rIdx % 2 === 1 ? 'bg-slate-50/50' : 'bg-white';
                                    const tds = cells.map((cell, idx) => {
                                        const align = alignments[idx] || 'text-left';
                                        return `<td class="py-1.5 px-2.5 text-[#1a1c1e] text-[11px] ${align} leading-relaxed">${inline(cell)}</td>`;
                                    }).join('');
                                    return `<tr class="${bg} hover:bg-blue-50/40 transition-colors">${tds}</tr>`;
                                }).join('') +
                                '</tbody>';

                            return '<div class="my-2.5 overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-2xs"><table class="min-w-full text-left border-collapse text-[11px]">' + thead + tbody + '</table></div>';
                        };

                        const lines = safe.split('\n');
                        const parts = [];
                        let listItems = [];
                        let currentListType = null; // 'ul' | 'ol'

                        const flushList = () => {
                            if (listItems.length) {
                                if (currentListType === 'ol') {
                                    parts.push('<ol class="list-decimal pl-4 my-1 space-y-1">' + listItems.join('') + '</ol>');
                                } else {
                                    parts.push('<ul class="list-disc pl-4 my-1 space-y-1">' + listItems.join('') + '</ul>');
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
                                    '<div class="code-block-wrapper my-2 rounded-xl overflow-hidden border border-slate-700 bg-slate-900 shadow-xs">' +
                                        '<div class="flex items-center justify-between px-2.5 py-1 bg-slate-800 text-slate-400 text-[10px] font-mono border-b border-slate-700/80 select-none">' +
                                            '<span class="text-slate-300 font-semibold lowercase">' + (lang || 'code') + '</span>' +
                                            '<button type="button" onclick="window.copyCodeSnippet(this)" class="hover:text-white transition-colors cursor-pointer inline-flex items-center gap-1 px-1.5 py-0.5 rounded hover:bg-slate-700">' +
                                                '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>' +
                                                '<span>Salin</span>' +
                                            '</button>' +
                                        '</div>' +
                                        '<pre class="p-2.5 text-slate-100 text-[11px] font-mono overflow-x-auto leading-relaxed"><code>' + codeLines.join('\n') + '</code></pre>' +
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
                                parts.push('<blockquote class="border-l-3 border-[#0453cd] bg-blue-50/60 pl-2.5 pr-2 py-1.5 my-2 rounded-r-lg text-[11px] text-slate-700 leading-relaxed shadow-2xs">' + quoteContent + '</blockquote>');
                                continue;
                            }

                            // Horizontal Rule
                            if (/^(\*{3,}|-{3,}|_{3,})$/.test(line.trim())) {
                                flushList();
                                parts.push('<hr class="my-2.5 border-t border-slate-200">');
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
                                    parts.push('<h4 class="font-extrabold text-xs sm:text-[13px] mt-2.5 mb-1 text-[#000c46] tracking-tight">' + hText + '</h4>');
                                } else if (level === 2) {
                                    parts.push('<h5 class="font-bold text-[11px] sm:text-xs mt-2 mb-0.5 text-[#000c46]">' + hText + '</h5>');
                                } else {
                                    parts.push('<h6 class="font-bold text-[10px] mt-1.5 mb-0.5 text-[#0453cd] uppercase tracking-wider">' + hText + '</h6>');
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
                                    ? '<span class="inline-flex items-center justify-center w-3.5 h-3.5 rounded bg-emerald-100 text-emerald-700 text-[10px] font-bold shrink-0">✓</span>'
                                    : '<span class="inline-flex items-center justify-center w-3.5 h-3.5 rounded border border-slate-300 bg-white text-transparent text-[10px] shrink-0">○</span>';
                                listItems.push('<li class="flex items-start gap-1.5 list-none -ml-4 my-0.5 leading-relaxed">' + checkBadge + '<span>' + inline(task[2]) + '</span></li>');
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
                                    parts.push('<div class="h-1.5"></div>');
                                } else {
                                    parts.push('<p class="my-0.5 leading-relaxed">' + inline(line) + '</p>');
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
            registerAiChatComponent();
        } else {
            document.addEventListener('alpine:init', registerAiChatComponent);
        }
    })();
</script>
