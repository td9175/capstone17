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
      encodingType: this.camera.EncodingType.JPEG,
      sourceType: this.camera.PictureSourceType.CAMERA,
      mediaType: this.camera.MediaType.PICTURE
    }

    this.camera.getPicture(options).then((imageData) => {
      console.log("imageData from image_fire() here: ", imageData);
      return imageData;
    }, (err) => {
        console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
    });
  }

  image_pick() {
    const options = {
      quality: 50,
      destinationType: this.camera.DestinationType.FILE_URI,
      encodingType: this.camera.EncodingType.JPEG,
			sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,
      mediaType: this.camera.MediaType.PICTURE
    }
    this.camera.getPicture(options).then((imageData) => {
      console.log("imageData from image_pick() here: ", imageData);
      return imageData;
    }, (err) => {
        console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
    });
  }
}
