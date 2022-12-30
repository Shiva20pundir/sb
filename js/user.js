
 const sliderImg = document.querySelectorAll('.slider-img'); 
 let index = 0;
	const nextSlide = () => {
		if (index === sliderImg.length - 1) {
			index = 0;
		} else {
			index++;
		}
	};
	const activeSlider = () => {
		for (var i =  0; i < sliderImg.length; i++) {			
			sliderImg[i].classList.remove('slider-active-img');
		}
		sliderImg[index].classList.add('slider-active-img');
	};

    const generateLink = () => {
    	const m_cards = document.querySelectorAll('.m-row .m-card');
    	for (const card of m_cards) {
		  card.onclick = () => {
		  	window.location = card.dataset.url;
		  }
		}
    };
    

	document.addEventListener('DOMContentLoaded', ()=>{		
		setInterval(() => {
			nextSlide();
			activeSlider();
		}, 5000);
		generateLink();
	});

