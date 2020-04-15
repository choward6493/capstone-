/* @pjs preload="images/americano.jpg,images/caffe_macchiato.jpg,images/caffe_mocha.jpg,images/cappuccino.jpg,images/caramel_latte.jpg,images/caramel_macchiato.jpg,images/darkchocolatemocha.jpg,images/espresso.jpg,images/havana_cappuccino.jpg,images/honey_lavender_latte.jpg,images/iced_caffe_mocha.jpg,images/iced_latte.jpg,images/iced_vanilla_latte.jpg,images/white_chocolate_mocha.jpg"; crisp=true;*/

//screen size
int[] screenC={1000,1000};
//image size
int[] imageC={150,125};

//this is preload string
String[] imageNames=split("images/americano.jpg,images/caffe_macchiato.jpg,images/caffe_mocha.jpg,images/cappuccino.jpg,images/caramel_latte.jpg,images/caramel_macchiato.jpg,images/darkchocolatemocha.jpg,images/espresso.jpg,images/havana_cappuccino.jpg,images/honey_lavender_latte.jpg,images/iced_caffe_mocha.jpg,images/iced_latte.jpg,images/iced_vanilla_latte.jpg,images/white_chocolate_mocha.jpg",',');
//array of actual images
PImage[] imageArray= new PImage[imageNames.length];
//populate array
for(var i=0;i<imageNames.length;i++;){
    imageArray[i]=loadImage(imageNames[i]);
}
int[] imageXArray=new int[imageNames.length];
int[] imageYArray=new int[imageNames.length];



//space in between images and outside of screen
int imageMargin=30;


var color1,color2,color3;
color1=100;color2=100;color3=100;

var numWide=Math.floor((screenC[0]-imageMargin)/(imageC[0]+imageMargin));


//space on one side to center
var fullMargin=(screenC[0]-(numWide*(imageC[0]+imageMargin)+imageMargin))/2;
//println(numWide+"what"+fullMargin);
var imageyY=100;

void setup(){
    size(screenC[0],screenC[1])
    background(255);
    noStroke();
    fill(100);
    //println("testing");

    //populate array of image information
    for(var i=0;i<imageNames.length;i++;){
        //imageArray[0]=loadImage("name.jpg");
        //image(variable,x,y,width,height);

        //POSSIBLE CHANGE THE Y THROUGH MODULOUS/MATH.FLOOR INSTEAD OF IF STATEMENTS
        if((numWide/i)<=(1/8)){
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-(4*numWide))));
            imageYArray[i]=5*(imageyY)+(4*imageC[1]);
        }else if((numWide/i)<=(1/4)){
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-(3*numWide))));
            imageYArray[i]=4*(imageyY)+(3*imageC[1]);
        }
        else if((numWide/i)<=(1/2)){  
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-(2*numWide))));
            imageYArray[i]=3*(imageyY)+(2*imageC[1]);
        }else if((numWide/i)<=1){
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*(i-numWide)));
            imageYArray[i]=2*(imageyY)+imageC[1];
            //println(imageyY);
            //console.log(imageyY);
        }else{
            imageXArray[i]=(fullMargin+imageMargin+((imageC[0]+imageMargin)*i));
            imageYArray[i]=imageyY;
        }
        
    }
}


void draw(){
    fill(color1,color2,color3);

    
    

    //rect(30,20,55,55);
    //rect(30,80,10,10);
}

void mouseReleased() {
    //mouseX, mouseY

}

void mouseMoved(){

}