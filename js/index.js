//Dom
    function myChangeColor(){
        document.getElementById('hello').append(' World')
        document.getElementById('hello').style.color = 'Red'
    }
    document.getElementById("demo2").addEventListener("mouseover", mouseOver);
    document.getElementById("demo2").addEventListener("mouseout", mouseOut);

    function mouseOver() {
        document.getElementById("demo2").style.color = "red";
    }

    function mouseOut() {
        document.getElementById("demo2").style.color = "black";
    }


//variable

    //const
    const name = 'Thanh';
    const age = 19;

    // var/let
    var a, b;
    a = 9
    b = 6
    let c = a + b
    console.log(c)
    console.log(typeof c)

//function
    function message(){
        alert(name + " " + age+ " tuoi")
    }
    message()

//arrow function
    Div = (a,b) =>{return a-b}
    console.log(Div(a,b));

//if else

    if(a===b) {
        console.log('a bang b')
    }
    else console.log('a ko bang b')

// switch case

    var number = parseInt(prompt("Enter number: "));
    switch (number%2){
        case 1:
            console.log('le');
            break;
        case 0:
            console.log('chan');
            break;
    }

//array - Object
    let arrNumber = [2,6,7,8,9,5,4];
    const country = ['vietnam', 'lao', 'thailan']
    console.log(country)
    country[1] = 'campuchia'
    country.push('anh')
    console.log(country)

    var animal = {
        name: 'tiger',
        speak: 'gam',
        color: {
            head: 'white',
            body: 'black'
        }
    }
    console.log(animal.color);

// for /foreach/ reduce
    console.log('sort: '+arrNumber.sort())
    let sum = 0;
    for(let i = 0; i<arrNumber.length; i++){
        sum += arrNumber[i]
        console.log(arrNumber[i])
    }
    console.log('Tong: '+ sum)

    sum = 0;
    arrNumber.forEach(a => sum +=a);
    console.log('Forech: '+ sum);
    console.log('reduce: ' + arrNumber.reduce((a,b)=> a+b , 0))

//class

    class Animal{
        constructor(name, color, weight) {
            this.name = name;
            this.color = color;
            this.weight = weight;
        }
        display(){
            return "ten: " + this.name + ", mau: " + this.color + ", nang: "+ this.weight
        }
    }
    class Dog extends Animal{
        constructor(name, color, weight, type) {
            super(name, color, weight);
            this.type = type
        }
        display() {
            return super.display() + ", type: " +this.type;
        }

    }

    Ani = new Animal('lulu', 'black', 15)
    console.log(Ani)

    dog = new Dog('ki', 'yellow', 12, 'husky')
    Dog.prototype.height = 50
    console.log("dog: " + dog)
    console.log(dog)
    console.log('height: ' + dog.height)


$(document).ready(function (){
    $('#hide').click(function (){
        $('#demo').hide()
    })
    $('#show').click(function (){
        $('#demo').show()
    })
})

