'use strict'

let lightBulbs
let currentOp = 1, loop = 0

function onStart() {
    lightBulbs = document.getElementsByClassName('light-bulb')
    setInterval(() => {
        for (let i = 0; i < lightBulbs.length; i++) {
            lightBulbs[i].style.opacity = Math.random();
            lightBulbs[i].style.fill = '#C' + 
                Math.ceil(Math.random() * 2 + 5) + 'D' + 
                Math.ceil(Math.random() * 2 + 4) + '' +
                Math.ceil(Math.random() * 20 + 0);
        }
        currentOp = 1 - currentOp
        loop = (loop + 1) % lightBulbs.length
    }, 240);

    setTimeout(() => {
        window.location.href = 'page_eventinfo.php'
    }, 4500);
}
