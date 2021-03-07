var app = new Vue({
    el: "#app",
    data: {
		products: [],
        timestamp : "",
        shoptitel : "Lager Buchshop G16"
    },
    methods: {
		fetchData(){
			fetch("data.php")
			.then(response => response.json())
			.then((data) => {
			  this.products = data;
			  console.log(this.products);
			})
		},
		increase(index){
			this.products[index].Lagerbestand++;
		},
		decrease(index){
			if(this.products[index].Lagerbestand > 0)
				this.products[index].Lagerbestand--;
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
});