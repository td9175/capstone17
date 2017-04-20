import { MyVaultPage } from './../my-vault/my-vault';
import { AddReceiptPage } from './../add-receipt/add-receipt';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Camera } from '@ionic-native/camera';
import { ReceiptPoster } from './../shared/receipt-post.service';
import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'
import { ActionSheetController } from 'ionic-angular';

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

  constructor(public navCtrl: NavController, public navParams: NavParams, public camera: Camera, public receiptPoster: ReceiptPoster, private actionSheet: ActionSheet, private actionSheetCtrl: ActionSheetController) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad VaultPage');
  }

  fireUploadSheet() {
    let actionSheet = this.actionSheetCtrl.create({
      title: 'Select an image from:',
      buttons: [
        {
          text: 'Photo Library',
          handler: () => {
            //this.takePicture(Camera.PictureSourceType.PHOTOLIBRARY);
          }
        },
        {
          text: 'Take Picture with Camera',
          handler: () => {
            //this.takePicture(Camera.PictureSourceType.CAMERA);
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
