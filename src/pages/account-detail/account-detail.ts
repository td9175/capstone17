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

  userHasTransaction: boolean;
  userHasBalance: boolean;

  userHasHSA: boolean = false;
  userHasFSA: boolean = false;

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
        if (data == `No HSA transaction history exists.`) {
          this.userHasTransaction = false;
          console.log('userHasTransaction HSA: ', this.userHasTransaction);
        } else {
          this.userHasTransaction = true;
          this.transactions = data;
          console.log('HSA Transactions: ', this.transactions)
          console.log('userHasTransaction HSA: ', this.userHasTransaction);
        }
      },
    );
  }

  loadFSATransaction(){
    this.userApi.getFsaTransaction().then(
      data => {
        if (data == `No FSA transaction history exists.`) {
          this.userHasTransaction = false;
          console.log('userHasTransaction FSA: ', this.userHasTransaction);
        } else {
          this.userHasTransaction = true;
          this.transactions = data;
          console.log('FSA Transactions: ', this.transactions)
          console.log('userHasTransaction FSA: ', this.userHasTransaction);
        }
      },
    );
  }

  // balance loads

  loadHSABalance(){
    this.userApi.getHsaBalance().then(
      data => {
        if (data == `Error: could not calculate HSA account balance.`) {
          this.userHasBalance = false;
          console.log('userHasBalance HSA: ', this.userHasBalance);
        } else {
          this.userHasBalance = true;
          this.remainingBalance = data;
          console.log('HSA Balance: ', this.remainingBalance)
          console.log('userHasBalance HSA: ', this.userHasBalance);
        }
      },
    );
  }

  loadFSABalance(){
    this.userApi.getFsaBalance().then(
      data => {
        if (data == `Error: could not calculate FSA account balance.`) {
          this.userHasBalance = false;
          console.log('userHasBalance FSA: ', this.userHasBalance);
        } else {
          this.userHasBalance = true;
          this.remainingBalance = data;
          console.log('FSA Balance: ', this.remainingBalance)
          console.log('userHasBalance FSA: ', this.userHasBalance);
        }
      },
    );
  }

  getTransactionDetails(){
    if (this.accountType == "HSA"){
      this.userHasHSA = true;
      this.loadHSABalance();
      this.loadHSATransaction();
      console.log("userHasHsa: ", this.userHasHSA)
    }
    else{
      this.userHasFSA = true;
      this.loadFSABalance();
      this.loadFSATransaction();
      console.log("userHasHsa: ", this.userHasFSA)
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
