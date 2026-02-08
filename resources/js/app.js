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

Alpine.start()
