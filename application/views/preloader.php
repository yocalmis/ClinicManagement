<style type="text/css">
	#preloader{
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		width: 100vw;
		height: 100vh;
		opacity: 1;
		visibility: visible;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flex;
		display: -o-flex;
		display: flex;
		-webkit-flex-direction: column;
		-moz-flex-direction: column;
		-ms-flex-direction: column;
		-o-flex-direction: column;
		flex-direction: column;
		-ms-align-items: center;
		align-items: center;
		z-index: 9999;
		background-color: #fff;
		-webkit-transition: opacity 250ms ease;
		-o-transition: opacity 250ms ease;
		transition: opacity 250ms ease;
	}
	.done{
		opacity: 0;
		visibility: hidden;
	}
	.circular {
		animation: rotate 2s linear infinite;
		max-width: 150px;
		height: 100%;
		width: 100%;
		transform-origin: center center;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		margin: auto;
	}
	.path {
		stroke-dasharray: 1, 200;
		stroke-dashoffset: 0;
		animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
		stroke-linecap: round;
	}
	@keyframes rotate {
		100% {
			transform: rotate(360deg);
		}
	}
	@keyframes dash {
		0% {
			stroke-dasharray: 1, 200;
			stroke-dashoffset: 0;
		}
		50% {
			stroke-dasharray: 89, 200;
			stroke-dashoffset: -35px;
		}
		100% {
			stroke-dasharray: 89, 200;
			stroke-dashoffset: -124px;
		}
	}
	@keyframes color {
		100%, 0% {
			stroke: #d62d20;
		}
		40% {
			stroke: #0057e7;
		}
		66% {
			stroke: #008744;
		}
		80%, 90% {
			stroke: #ffa700;
		}
	}



</style>
<div id="preloader">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
	</svg>
</div>