import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';
import { Http, Headers } from '@angular/http';
import { ReceiptPoster } from './../shared/receipt-post.service';
import { OcrUploadImageModel } from './../../models/ocruploadimage.model';


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
  model = new OcrUploadImageModel('');
  
  ocrreply: any;
  private resultData: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, private receiptPoster: ReceiptPoster, private loadingController: LoadingController, private camera: Camera) {
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

    let loader = this.loadingController.create({
      content: 'Please wait...'
    });

    loader.present().then(() => {
          this.camera.getPicture(options).then((imageData) => {
          console.log("imageData from image_fire() here: ", imageData);
          return imageData;
        }, (err) => {
            console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
        });
        this.receiptPoster.postReceiptForm(this.model)
        .subscribe(
          data => this.ocrreply = data.somethingReturned,
          err => console.log('error: ', err),
          () => console.log('Something returned: ', this.ocrreply),
        );
        loader.dismiss();
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

    let loader = this.loadingController.create({
      content: 'Please wait...'
    });

    loader.present().then(() => {
          this.camera.getPicture(options).then((imageData) => {
          console.log("imageData from image_pick() here: ", imageData);
          return imageData;
        }, (err) => {
            console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
        });
        this.receiptPoster.postReceiptForm(this.model)
        .subscribe(
          data => this.ocrreply = data.somethingReturned,
          err => console.log('error: ', err),
          () => console.log('Something returned: ', this.ocrreply),
        );
        loader.dismiss();
    });
  }
}
