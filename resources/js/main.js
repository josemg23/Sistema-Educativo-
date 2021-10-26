const dragable = document.querySelector('.drag');


dragable.addEventListener('dragstart', () =>{
	
	dragable.dataTransfer.setData('text/plain', 'V')

});
