<div x-data="audioPlayer" 
    x-show="isPlaying"
    x-cloak 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    class="fixed bottom-0 left-0 right-0 bg-bg-muted border-t border-brand p-4 shadow-2xl z-50"
>
    
    <div class="max-w-4xl mx-auto flex items-center gap-4">
        
        <div class="hidden sm:flex items-center gap-3 w-1/4">
            <img :src="currentCover" class="w-12 h-14 rounded shadow-sm object-cover">
            <div class="truncate">
                <p class="text-sm font-bold truncate" x-text="currentTitle"></p>
                <p class="text-sm text-text-muted">Audiobook</p>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center gap-1">
            <div class="flex items-center gap-6">
                <button @click="skip(-10)" title="Skip 10s backard" class="hover:text-brand-accent cursor-pointer">
                    <x-lucide-rotate-ccw class="w-5 h-5"/>
                </button>
                
                <button @click="togglePlay()" class="p-2 bg-brand-hover text-brand-accent-2 rounded-full hover:scale-105 transition cursor-pointer">
                    <template x-if="!isPaused">
                        <x-lucide-pause class="w-6 h-6" />
                    </template>
                    <template x-if="isPaused">
                        <x-lucide-play class="w-6 h-6" />
                    </template>
                </button>

                <button @click="skip(10)" title="Skip 10s forward" class="hover:text-brand-accent cursor-pointer">
                    <x-lucide-rotate-cw class="w-5 h-5"/>
                </button>
            </div>
            
            {{-- progress bar --}}
            <div class="relative mt-1 group w-full bg-brand h-1.5 hover:h-2 rounded-full transition-all cursor-pointer relative" 
                    @click="seek($event)"
                    @mousemove="handleHover($event)"
                    @mouseleave="showTooltip = false"
            >
                <div class="bg-brand-accent h-full transition-all" :style="`width: ${progress}%`"></div>

                {{-- hover tooltip --}}
                <template x-if="showTooltip">
                    <div 
                        class="absolute bottom-4 -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded shadow-lg pointer-events-none"
                        :style="`left: ${hoverLeft}px`"
                    >
                        <span x-text="hoverTime"></span>
                        {{-- tooltip's triangle --}}
                        <div class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-black"></div>
                    </div>
                </template>
            </div>

            {{-- timers --}}
            <div class="w-full flex justify-between items-center text-sm font-mono text-text-muted mt-0.5">
                <span x-text="currentTime"></span>
                <span x-text="totalDuration"></span>
            </div>
        </div>

        <div class="w-1/4 flex justify-end">
            <button @click="stop" class="hover:text-red-500 cursor-pointer"><x-lucide-x class="w-5 h-5"/></button>
        </div>
    </div>

    <audio x-ref="audioPlayer" @timeupdate="updateProgress" @ended="stop"></audio>
</div>