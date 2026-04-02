import './bootstrap'
import Alpine from 'alpinejs'
import Cropper from 'cropperjs'

window.Alpine = Alpine
window.Cropper = Cropper


Alpine.store('theme', {
    mode: localStorage.getItem('mode') || 'default',
    previous: localStorage.getItem('previous') || 'default',

    init() {
        document.documentElement.classList.add(this.mode)
    },

    set(mode) {
        document.documentElement.classList.remove(this.mode)
        // remember the current theme before switching to dark mode,
        // so we can restore it when dark mode is turned off
        if (mode === 'dark' && this.mode !== 'dark') {
            this.previous = this.mode
            localStorage.setItem('previous', this.previous)
        }
        this.mode = mode
        localStorage.setItem('mode', this.mode)
        document.documentElement.classList.add(this.mode)
    },

    toggleDark() {
        if (this.mode === 'dark') {
            // return to previous theme
            this.set(this.previous || 'default')
        } else {
            this.set('dark')
        }
    }
})

Alpine.store('locale', {
    current: document.documentElement.lang || 'en',

    async set(locale) {
        if (this.current === locale) return

        this.current = locale
        localStorage.setItem('locale', locale)

        document.documentElement.lang = locale
        document.documentElement.dir = locale === 'ar' ? 'rtl' : 'ltr'

        await fetch('/locale', {
            method: 'POST',
            headers: {
                'X-Locale': localStorage.getItem('locale'),
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ locale }),
        })

        window.location.reload()
    },
})

function audioPlayer() {
    return {
        isPlaying: false,
        isPaused: true,
        progress: 0,
        currentTitle: '',
        currentCover: '',
        currentTime: '0:00',
        totalDuration: '0:00',
        hoverTime: '0:00',
        hoverLeft: 0,
        showTooltip: false,
        
        // from $dispatch
        init() {
            window.addEventListener('play-audio', (e) => {
                this.playAudio(e.detail.url, e.detail.title, e.detail.cover);
            });
            this.$refs.audioPlayer.addEventListener('loadedmetadata', () => {
                this.totalDuration = this.formatTime(this.$refs.audioPlayer.duration);
            });
        },
        playAudio(url, title, cover) {
            this.currentTitle = title;
            this.currentCover = cover;
            this.$refs.audioPlayer.src = url;
            this.$refs.audioPlayer.play();
            this.isPlaying = true;
            this.isPaused = false;
        },
        togglePlay() {
            if (this.$refs.audioPlayer.paused) {
                this.$refs.audioPlayer.play();
                this.isPaused = false;
            } else {
                this.$refs.audioPlayer.pause();
                this.isPaused = true;
            }
        },
        updateProgress() {
            const player = this.$refs.audioPlayer;
            const duration = player.duration;
            
            if (duration) {
                this.progress = (player.currentTime / duration) * 100;
                this.currentTime = this.formatTime(player.currentTime);
                // this.totalDuration = this.formatTime(duration);
            }
        },
        seek(event) {
            let player = this.$refs.audioPlayer;

            if (!player.duration) return;

            let rect = event.currentTarget.getBoundingClientRect(); // position + size of the progress bar
            let clickX = event.clientX - rect.left;
            let width = rect.width;

            let percent = clickX / width;

            player.currentTime = percent * player.duration;
        },
        // you should be working on a server that supports http byte-range requests for this to work
        skip(seconds) {
            let player = this.$refs.audioPlayer;
            
            let newTime = player.currentTime + seconds;
            
            if (newTime < 0) {
                newTime = 0;
            }

            if (newTime > player.duration) {
                newTime = player.duration;
            }
            player.currentTime = newTime;
            
        },
        stop() {
            this.$refs.audioPlayer.pause();
            this.isPlaying = false;
            this.isPaused = true;
        },
        handleHover(event) {
            const player = this.$refs.audioPlayer;
            if (!player.duration) return;

            const rect = event.currentTarget.getBoundingClientRect();
            const x = event.clientX - rect.left; // mouse position inside the bar
            const percent = x / rect.width;
            const targetSeconds = percent * player.duration;

            this.hoverTime = this.formatTime(targetSeconds);
            this.hoverLeft = x; // pixel position for the tooltip
            this.showTooltip = true;
        },
        formatTime(seconds) {
            if (!seconds || isNaN(seconds)) return '0:00';
            
            const h = Math.floor(seconds / 3600);
            const m = Math.floor((seconds % 3600) / 60);
            const s = Math.floor(seconds % 60);

            const parts = [];
            if (h > 0) parts.push(h); 
            parts.push(h > 0 ? m.toString().padStart(2, '0') : m);
            parts.push(s.toString().padStart(2, '0'));

            return parts.join(':');
        },
    }
}
Alpine.data('audioPlayer', audioPlayer);

Alpine.start()
