document.addEventListener("DOMContentLoaded", () => {

	const $searchButton = document.querySelector(".search-button");

	
	const $fieldError = document.querySelector(".field-error");
	const $dateError = document.querySelector(".date-error");
	
	$searchButton.addEventListener("click", (e) =>{	
		
		
		const $city = document.querySelector("#city");
		const $roomType = document.querySelector("#room-type");
		const $checkInDate = document.querySelector(".check-in-date");
		const $checkOutDate = document.querySelector(".check-out-date");
		
		if($city.options[$city.selectedIndex].value == '' || $roomType.options[$roomType.selectedIndex].value == ''){
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