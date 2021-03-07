var app = new Vue({
    el: "#app",
    data: {
		products: [],
		cart: [],
        timestamp : "",
		cart_url_param : "",
		Summe: 0.00,
		filtered_books: [],
		cart_array: [],
		search:"",
        shoptitel : "Lager Buchshop G16"
		
    },
    methods: {
		fetchData(){
			fetch("data.php")
			.then(response => response.json())
			.then((data) => {
			for(var i = 0; i < data.length;i++)
				{
					data[i].AnzWarenkorb = 0;
					data[i].InKorb = false;
					data[i].Posi = i;
					
				}
			  this.products = data;
			  console.log(this.products);
			})
		},
		increase(index){
			if(this.products[index].AnzWarenkorb < this.products[index].Lagerbestand)
			this.products[index].AnzWarenkorb++;
			
		},
		decrease(index){
			if(this.products[index].AnzWarenkorb > 0)
				this.products[index].AnzWarenkorb--;
		},
		add_to_cart(index){
			
			this.products[index].InKorb = true;
			this.calc_sum();
		},
		remove_from_cart(index){
			
			this.products[index].InKorb = false;
			this.calc_sum();
		},
		calc_sum(){
			
			this.Summe = 0.00;
			for(var  i = 0; i<this.products.length;i++){
				
				if(this.products[i].InKorb){
					
					this.Summe = parseFloat(this.Summe) + (parseFloat(this.products[i].PreisNetto) * parseFloat(this.products[i].AnzWarenkorb));
					this.Summe = this.Summe.toFixed(2);
				}
			}
			this.create_cart_url();
		},
		create_cart_url(){
			
			cart_array=[];
			cart_url_param ="";
			for(var  i = 0; i<this.products.length;i++){
				if(this.products[i].InKorb==true){
					cart_array.push(this.products[i]);
				}
			}
		},
		now(){
			const today = new Date();
			const date = today.getDate()
							+ '.'+(today.getMonth()+1)
							+ '.'+today.getFullYear();
			const time = today.getHours() 
							+ ":" + today.getMinutes()
							+ ":" + today.getSeconds();
			const dateTime = "Datum: " + date +' Uhrzeit: '+ time;
			this.timestamp  = dateTime;
		}
	},
	created () {
			setInterval(this.now, 1000);
	},
	mounted () {
			this.fetchData();
	},
	computed: {
		filteredBooks(){
			
			// Suchfilter mit zwei Eingabefeldern search und search2
			return this.products.filter((product) => {
				return ( product.Produktitel.match(new RegExp(this.search, 'i')) || product.Autorname.match(new RegExp(this.search, 'i')) || product.Produktcode.match(new RegExp(this.search, 'i')) )
			});
		},
}});

function cart_on() {
  document.getElementById("cart_overlay").style.display = "block";
}

function cart_off() {
  document.getElementById("cart_overlay").style.display = "none";
}



	var checkoutButton = document.getElementById('checkout-button');
	var stripe = Stripe('pk_test_51I5WDBLX99dchKCcjqsxLgJfdLKVurLNaOQSxgRcrReKZyhEdKujHGJpq8v3z37cVuFVrx9sOKPbAjjEp6qdNYOt00YaxdPZUa'); // Nichts ändern ! Public key oben definiert !!!



	app.products.PreisNetto

	function order_items(){

		var item_data = [];
		
		for(var i = 0; i<app.products.length;i++){
			
			if(app.products[i].InKorb){
			item_data.push( 
				
				{
				name: app.products[i].Produktitel,
				description :  app.products[i].Kurzinhalt,
				amount : parseInt(parseFloat(app.products[i].PreisNetto).toFixed(2)*100),
				currency : 'eur',
				quantity :app.products[i].AnzWarenkorb,
				})
				
			}
		}
	
		console.log(item_data[0]);

		 fetch('./datenadm/restshop/api/create-checkout-session', {
		 		body: JSON.stringify(item_data),
				method: 'POST',
				headers: {
						"Content-Type": "application/json",
					},
		 	})
		 	.then(function (response) {
		 		console.log(response);
		 		return response.json();
		 		//return response;
		 	})
		 .then(function (session) {
				
				console.log(session);
				return stripe.redirectToCheckout({
		 			sessionId: session.id

				});
				
			})
		 	.then(function (result) {
				// If `redirectToCheckout` fails due to a browser or network
		 		// error, you should display the localized error message to your
		 		// customer using `error.message`.
		 		if (result.error) {
		 			alert(result.error.message);
		 		}
		 	})
		 	.catch(function (error) {
		 		console.error(error);
		 	});
	};
