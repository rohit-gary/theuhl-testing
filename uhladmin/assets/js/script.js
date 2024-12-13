const root = document.documentElement;
    const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");
    const marqueeContent = document.querySelector("ul.marquee-content");

    root.style.setProperty("--marquee-elements", marqueeContent.children.length);

    for (let i = 0; i < marqueeElementsDisplayed; i++) {
        marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
    }
    window.onload = function() {
        if (!sessionStorage.getItem('reloaded')) {
            sessionStorage.setItem('reloaded', true);
            window.location.reload(true);
        }
    };
