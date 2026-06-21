const transition = document.getElementById('pixel-page-transition')

if (transition) {
    const cols = 12
    const rows = 7

    const waveDuration = 900
    const extraDelay = 150

    let maxDelay = 0
    let isTransitioning = false

    transition.style.setProperty('--cols', cols)
    transition.style.setProperty('--rows', rows)

    transition.innerHTML = ''

    for (let y = 0; y < rows; y++) {
        for (let x = 0; x < cols; x++) {
            const pixel = document.createElement('div')
            pixel.className = 'pixel-page-transition__pixel'

            const progressX = x / (cols - 1)

            const delay = progressX * waveDuration

            maxDelay = Math.max(maxDelay, delay)
            pixel.style.setProperty('--delay', `${delay}ms`)

            transition.appendChild(pixel)
        }
    }

    const enterDuration = maxDelay + extraDelay
    const exitDuration = maxDelay + extraDelay

    function startTransition(href) {
        if (isTransitioning) return
        isTransitioning = true

        // 1. ENTER animation
        transition.classList.remove('is-leaving')
        transition.classList.add('is-entering')

        // 2. Ждём пока экран полностью закроется
        setTimeout(() => {

            // 3. Делаем реальный переход
            window.location.href = href

        }, enterDuration)
    }

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a.js-page-transition')

        if (!link) return

        const href = link.getAttribute('href')

        if (
            !href ||
            href.startsWith('#') ||
            link.target === '_blank' ||
            event.metaKey ||
            event.ctrlKey ||
            event.shiftKey ||
            event.altKey
        ) return

        event.preventDefault()
        startTransition(href)
    })

    // ВАЖНО: новая страница должна СРАЗУ стартовать с "закрытого" состояния
    document.addEventListener('DOMContentLoaded', () => {
        transition.classList.add('is-entering')

        setTimeout(() => {
            transition.classList.remove('is-entering')
            transition.classList.add('is-leaving')
            isTransitioning = false
        }, exitDuration)
    })
}
