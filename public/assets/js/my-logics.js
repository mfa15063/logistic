document.body.onscroll = function () {
    let style = document.getElementById('scroll-style');
    style.textContent = `
        ::-webkit-scrollbar {
          width: 15px;
          background: linear-gradient(to bottom, #feb900 0%, #feb900 ${parseInt(window.scrollY / document.body.scrollHeight * 100 + 3)}%, #ddd 0%, #ddd 100%);
          border-left: 1px solid #feb900;
          border-right: 1px solid #feb900;
        }
    
        ::-webkit-scrollbar-thumb {
          background-size: contain !important;
          background-image: url(https://www.freeiconspng.com/uploads/white-down-arrow-png-2.png);
          background-repeat: no-repeat;
          background-position: bottom;
          background-color: #feb900;
        }
    `;
}

let scrollToTop = document.getElementById('scroll-to-top');
scrollToTop.onclick = () => {
    window.scrollTo(0, 0);
}
