import { MyVaultPage } from './../my-vault/my-vault';
import { AddReceiptPage } from './../add-receipt/add-receipt';
import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';
//import { ReceiptPoster } from './../shared/receipt-post.service';
import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'
import { ActionSheetController } from 'ionic-angular';
//import { OcrUploadImageModel } from './../../models/ocruploadimage.model';
import { File } from '@ionic-native/file';
import { Http, Response, Headers, RequestOptions, URLSearchParams } from '@angular/http'
import { Transfer, FileUploadOptions, TransferObject } from '@ionic-native/transfer';
import { Injectable } from '@angular/core';
import { UserGlobals } from './../shared/user-api.service';

/*
  Generated class for the Vault page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-vault',
  templateUrl: 'vault.html'
})
export class VaultPage {

  receiptImage: any;
  parsedPrices: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public camera: Camera, private actionSheet: ActionSheet, private actionSheetCtrl: ActionSheetController, private loadingController: LoadingController, private http: Http, private userGlobals: UserGlobals) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad VaultPage');
  }

  public uploadImage(receiptImage) {
    // Destination URL
    var url = "https://capstone.td9175.com/ci/index.php/Receipt/upload_it/";
  
    // File for Upload
    var targetPath = receiptImage;
    var currentName = receiptImage.substr(receiptImage.lastIndexOf('/') + 1);
  
    // File name only
    var filename = currentName;

    var options = {
      fileKey: "userfile",
      fileName: filename,
      httpMode: "POST",
      chunkedMode: true,
      params : {token: `${this.userGlobals.getGlobalSession()}`, email: `${this.userGlobals.getGlobalEmail()}`}
    };
  
    const fileTransfer: TransferObject = new TransferObject();

    let loader = this.loadingController.create({
      content: 'Uploading...',
    });
    loader.present();
  
    // Use the FileTransfer to upload the image
    fileTransfer.upload(targetPath, url, options).then(data => {
      console.log("this is what we are getting back: ");
      console.dir(data);
      this.userGlobals.setParsedPrices(data.response);
      loader.dismissAll();
      //this.presentToast('Image succesful uploaded.');
    }, err => {
      loader.dismissAll();
      this.userGlobals.setParsedPrices([{"item": "error", "price": "error"}]);
      //this.presentToast('Error while uploading file.');
    });
  }

  image_fire() {
    const options = {
      quality: 65,
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
          this.uploadImage(imageData);
          this.userGlobals.sleep(2500).then(() => {console.dir(this.userGlobals.getParsedPrices())});
        }, (err) => {
            console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
        });
        loader.dismiss();
    });
  }

  image_pick() {
    const options = {
      quality: 65,
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
          this.uploadImage(imageData);
          this.userGlobals.sleep(2500).then(() => {console.dir(this.userGlobals.getParsedPrices())});
        }, (err) => {
            console.log("We couldn't grab the picture. Probably running in a browser or the camera failed. Error follows: ", err);
        });
        loader.dismiss();
    });
  }

  // private presentToast(text) {
  //   let toast = this.toastCtrl.create({
  //     message: text,
  //     duration: 3000,
  //     position: 'top'
  //   });
  //   toast.present();
  // }

  fireUploadSheet() {
    let actionSheet = this.actionSheetCtrl.create({
      title: 'Select an image from:',
      buttons: [
        {
          text: 'Take Photo with Camera',
          handler: () => {
            this.image_fire();
          }
        },
        {
          text: 'Camera Roll',
          handler: () => {
            this.image_pick();
          }
        },
        {
          text: 'Cancel',
          role: 'cancel'
        }
      ]
    });
    actionSheet.present();
  }

  loadAddRecieptPage(){
    this.navCtrl.push(AddReceiptPage)
  }

  loadUploadPage(){

  }

  loadMyVaultPage(){
    this.navCtrl.push(MyVaultPage);
  }

}
