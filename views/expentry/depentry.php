<style>
label {
    display: inline-block;
    margin-bottom: .5rem;
	font-weight: 500;
}

.row {
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.mb-2 {
    margin-bottom: .5rem!important;
}
.mb-3 {
    margin-bottom: 1rem!important;
}
.p-2 {
    padding: .5rem!important;
}
.border-primary {
    border-color: #158cba!important;
}
.border {
    border: 1px solid #196ec3!important;
}
.bg-secondary {
    background-color: #f0f0f0!important;
}
legend {
	margin-bottom: 5px;
}
.error {
	color: red;
}

@media (min-width: 992px) {
    .img-right {
        float: right;
    }
}

#overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 2;
    cursor: pointer;
}

#text {
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 25px;
    color: white;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
}

#loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    border-bottom: 16px solid red;
    width: 60px;
    height: 60px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

ul.ui-autocomplete { 
    max-height: 300px !important; 
    overflow: auto !important; 
}
textarea.form-control {
    height: 34px;
}

</style>

  <?php echo $this->dynform;?>

  <div id="overlay" style="display: none;">
	<div id="text">
		<div>Wait Processing . . .</div>
		<div id="loader"></div>
  	</div>
</div>

	
	