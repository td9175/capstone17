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
  remainingBalance: any;
  transactions: any;

  userHasHsa: boolean;
  userHasFsa: boolean;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {
    this.accountType = navParams.get('accountType');
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AccountDetailPage');
    this.getTransactionDetails();
  }

  // transaction loads

  loadHSATransaction(){
    this.userApi.getHsaTransaction().then(
      data => {
        if (data == `No HSA account exists.`) {
          this.userHasHsa = false;
          console.log('userHasHsa: ', this.userHasHsa);
        } else {
          this.userHasHsa = true;
          this.transactions = data;
          console.log('HSA Transactions: ', this.transactions)
          console.log('userHasHsa: ', this.userHasHsa);
        }
      },
    );
  }

  loadFSATransaction(){
    this.userApi.getFsaTransaction().then(
      data => {
        if (data == `No FSA transaction history exists.`) {
          this.userHasFsa = false;
          console.log('userHasFsa: ', this.userHasFsa);
        } else {
          this.userHasFsa = true;
          this.transactions = data;
          console.log('FSA Transactions: ', this.transactions)
          console.log('userHasFsa: ', this.userHasFsa);
        }
      },
    );
  }

  // balance loads

  loadHSABalance(){
    this.userApi.getHsaBalance().then(
      data => {
        if (data == `No HSA account exists.`) {
          this.userHasHsa = false;
          console.log('userHasHsa: ', this.userHasHsa);
        } else {
          this.userHasHsa = true;
          this.remainingBalance = data;
          console.log('HSA Balance: ', this.transactions)
          console.log('userHasHsa: ', this.userHasHsa);
        }
      },
    );
  }

  loadFSABalance(){
    this.userApi.getFsaBalance().then(
      data => {
        if (data == `Error: could not calculate FSA account balance.`) {
          this.userHasFsa = false;
          console.log('userHasFsa: ', this.userHasFsa);
        } else {
          this.userHasFsa = true;
          this.remainingBalance = data;
          console.log('FSA Balance: ', this.transactions)
          console.log('userHasFsa: ', this.userHasFsa);
        }
      },
    );
  }

  getTransactionDetails(){
    if (this.accountType == "HSA"){
      this.loadHSABalance();
      this.loadHSATransaction();
    }
    else{
      this.loadFSABalance();
      this.loadFSATransaction();
    }
  }

  /*
  getTransactionDetails(){
    if (this.accountType == "HSA"){
      this.userApi.getHsaTransaction().then(data => this.transactions = data);
      this.userApi.getHsaBalance().then(data => this.remainingBalance = data);
    }
    else{
      this.userApi.getFsaTransaction().then(data => this.transactions = data);
      this.userApi.getFsaBalance().then(data => this.remainingBalance = data);
    }
  }
  */

  goBack() {
    this.navCtrl.pop();
  }

}
