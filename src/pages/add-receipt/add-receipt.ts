import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';


/*
  Generated class for the AddReceipt page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-add-receipt',
  templateUrl: 'add-receipt.html'
})
export class AddReceiptPage {

  receiptImage: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private camera: Camera) {
    //this.receiptImage = this.image_fire()
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddReceiptPage');
  }

  goBack() {
    this.navCtrl.pop();
  }
  
  image_fire() {
    const options = {
      quality: 50,
      destinationType: this.camera.DestinationType.FILE_URI,
      //encodingType: this.camera.EncodingType.JPEG,
      sourceType: this.camera.PictureSourceType.CAMERA,
      //mediaType: this.camera.MediaType.PICTURE
    }

    this.camera.getPicture(options).then((imageData) => {
      console.log("imageData here: ", imageData);
      localStorage.setItem("tempPhoto", imageData);
      
      let base64Image = 'data:image/jpeg;base64,' + imageData;
      console.log("Base64 encoded jpeg follows: ", base64Image);
      return base64Image;
    }, (err) => {
        console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
    });
  }

  image_pick() {
    const options = {
      quality: 50,
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
			sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,
      mediaType: this.camera.MediaType.PICTURE
    }
    this.camera.getPicture(options).then((imageData) => {
      let chosenImage = 'data:image/jpeg;base64,' + imageData;
      console.log("Base64 encoded jpeg follows: ", chosenImage);
      return chosenImage;
    }, (err) => {
        console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
    });
  }
}
