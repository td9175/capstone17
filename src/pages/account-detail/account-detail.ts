import { UserApi } from './../shared/user-api.service';
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';

/*
  Generated class for the AccountDetail page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-account-detail',
  templateUrl: 'account-detail.html'
})
export class AccountDetailPage {
  
  accountType: any;

  transactions: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {
    this.accountType = navParams.get('accountType');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AccountDetailPage');

    if (this.accountType == "HSA"){
      this.userApi.getHsaTransaction().then(data => this.transactions = data);
    }
    else{
      this.userApi.getFsaTransaction().then(data => this.transactions = data);
    }
  }

  goBack() {
    this.navCtrl.pop();
  }

}
