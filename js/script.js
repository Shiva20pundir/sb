const hr_list = document.querySelector('.movie_hour');
const mn_list = document.querySelector('.movie_minute');
const sc_list = document.querySelector('.movie_second');

 const generateDropdown = ()=>{
 	for (let i = 0; i <= 12; i++) {
 		const optionElmnt = document.createElement('option');
 		
 		if (i >= 10) {
 			optionElmnt.innerText = i;
 		}else{
 			optionElmnt.innerText = '0'+i; 			
 		} 		
         
         hr_list.appendChild(optionElmnt);
 	}
 	for (let i = 0; i <= 59; i++) {
 		const optionElmnt = document.createElement('option');
 		
 		if (i >= 10) {
 			optionElmnt.innerText = i;
 		}else{
 			optionElmnt.innerText = '0'+i;
 		}
         
         mn_list.appendChild(optionElmnt);
 	}
 	for (let i = 0; i <= 59; i++) {
 		const optionElmnt = document.createElement('option');
 		
 		if (i >= 10) {
 			optionElmnt.innerText = i;
 		}else{
 			optionElmnt.innerText = '0'+i;
 		}
         
         sc_list.appendChild(optionElmnt);
 	}
 }
document.addEventListener('load', generateDropdown());
