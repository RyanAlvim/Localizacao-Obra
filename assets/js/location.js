navigator.geolocation.getCurrentPosition((pos)=>{
    	document.getElementById("latitude").value = `${pos.coords.latitude}`;
    	document.getElementById("longitude").value = `${pos.coords.longitude}`;
});
