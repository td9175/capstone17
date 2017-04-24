import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { ActionSheetController } from 'ionic-angular';
import { UserApi, UserGlobals, AuthService } from './../shared/user-api.service';

// Page Imports
import { UserSettingsPage } from './../user-settings/user-settings';
import { AccountDetailPage } from './../account-detail/account-detail';
import { LoginPage } from '../login/login';
import { AboutPage } from '../about/about';
import { HelpPage } from './../help/help';
import { TaxInfoPage } from './../tax-info/tax-info';
import { ReceiptFormPage } from './../receipt-form/receipt-form';
import { AddHSAPage } from './../add-hsa/add-hsa';
import { AddFSAPage } from './../add-fsa/add-fsa';

import { App } from 'ionic-angular';

@Component({
  selector: 'page-accounts',
  templateUrl: 'accounts.html'
})
export class AccountsPage {

  userhsas: any;
  userHasHsa: boolean;

  userfsas: any;
  userHasFsa: boolean;

  userinfos: any;
  loggedInUser: any;
  userLoggedIn: any;

  userhsabalance: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public actionSheetCtrl: ActionSheetController, private userApi: UserApi, public userGlobals: UserGlobals, public authService: AuthService, public app: App) { 
  }

  ionViewDidLoad() {
    this.loggedInUser = this.userGlobals.getGlobalEmail();
    if(this.userGlobals.isLoggedIn()==true) {
      this.userLoggedIn = true;
      this.loadUserHsa();
      this.loadUserFsa();
      this.loadUserData();
    } else {
      this.userLoggedIn = false;
    }

  }

  loadUserHsa(){
    this.userApi.getUserHSAData().then(
      data => {
        if (data == `No HSA account exists.`) {
          this.userHasHsa = false;
          console.log('userHasHSA: ', this.userHasHsa);
        } else {
          this.userHasHsa = true;
          this.userhsas = data;
          console.log('userHasHsa: ', this.userHasHsa);
          console.log('user HSA Data: ', this.userhsas);
        }
      },
    );
  }

  loadUserFsa(){
    this.userApi.getUserFSAData().then(
      data => {
        if (data == `No FSA account exists.`) {
          this.userHasFsa = false;
          console.log('userHasFsa: ', this.userHasFsa);
        } else {
          this.userHasFsa = true;
          this.userfsas = data;
          console.log('userHasFsa: ', this.userHasFsa);
          console.log('user FSA Data: ', this.userfsas);
        }
      },
    );
  }

  loadUserData(){
      this.userApi.getUserInfoData().then(
        data => {this.userinfos = data
          console.log("userinfo = ", this.userinfos);
      });
  }

  // for debugging.
  loginTest() {
    this.navCtrl.push(LoginPage);
  }

  logoutTest() {
    this.authService.appLogout();
    const root = this.app.getRootNav();
    root.popToRoot();
  }
  
  // Helpers for passing HSA or FSA type to account-detail page.
  loadHsaAccountDetails(event, accountType){
    accountType = "HSA";
    this.navCtrl.push(AccountDetailPage, { accountType: accountType });
  }

  loadFsaAccountDetails(event, accountType){
    accountType = "FSA";
    this.navCtrl.push(AccountDetailPage, { accountType: accountType });
  }

  // Navigation
  loadUserSettingsDetails(event, userinfo){
    this.navCtrl.push(UserSettingsPage, { userinfo: userinfo });
    //console.log("Userinfo to pass: ", userinfo);
  }

  loadAddHsa(event, userinfo){
    this.navCtrl.push(AddHSAPage, { userinfo: userinfo });
    console.log("Userinfo to pass to Add-Hsa: ", userinfo);
  }
  
  loadAddFsa(event, userinfo){
    this.navCtrl.push(AddFSAPage, { userinfo: userinfo });
    console.log("Userinfo to pass to Add-Fsa: ", userinfo);
  }

  loadHelpPage(){
    this.navCtrl.push(HelpPage);
  }

  loadTaxHelpPage(){
    this.navCtrl.push(TaxInfoPage);
  }

  loadAboutPage(){
    this.navCtrl.push(AboutPage);
  }

  receiptForm(){
    this.navCtrl.push(ReceiptFormPage)
  }

}
