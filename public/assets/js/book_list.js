document.addEventListener("DOMContentLoaded", () => {

    const $button = document.querySelector(".button");
    
    const $fieldError = document.querySelector(".field-error");
    const $dateError = document.querySelector(".date-error");
	
	$button.addEventListener("click", (e) =>{
		
		const $guests = document.querySelector("#guests");
		const $roomType = document.querySelector("#room-type");
		const $city = document.querySelector("#city");
		const $checkInDate = document.querySelector(".check-in-date");
		const $checkOutDate = document.querySelector(".check-out-date");
        console.log($roomType);
        
        if($city.options[$city.selectedIndex].value == '' || $roomType.options[$roomType.selectedIndex].value == '' || $guests.options[$guests.selectedIndex].value == ''){
            
			$fieldError.classList.remove("display-none");
			e.preventDefault();
		}else{
			$fieldError.classList.add("display-none");
		}

		if($checkInDate.value == '' || $checkOutDate.value == ''){
			$dateError.classList.remove("display-none");
			e.preventDefault();
		}else{
			$dateError.classList.add("display-none");
		}
	})
	
    $fieldError.classList.add("display-none");
    $dateError.classList.add("display-none");
})