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

  constructor(public navCtrl: NavController, public navParams: NavParams, private camera: Camera) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad AddReceiptPage');
  }

  goBack() {
    this.navCtrl.pop();
  }
  
    image_fire(){
      const options = {
        quality: 50,
        destinationType: this.camera.DestinationType.DATA_URL,
        encodingType: this.camera.EncodingType.JPEG,
        sourceType: 1,
        mediaType: this.camera.MediaType.PICTURE
      }

      this.camera.getPicture(options).then((imageData) => {
        let base64Image = 'data:image/jpeg;base64,' + imageData;
        console.log("here's your sign")
        console.log(base64Image)
      }, (err) => {
        console.log("Shit")
      });
    }
}
