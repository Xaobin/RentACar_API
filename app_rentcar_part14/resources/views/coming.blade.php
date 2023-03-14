@php
$valid_jwt=base64_decode($valid_jwt);
//echo $valid_jwt;
///*
echo "<script>
setTimeout(function() { window.location.href = 'home/$valid_jwt'; }, 1000);
</script>";
//*/
@endphp