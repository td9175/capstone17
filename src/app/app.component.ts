import { Component, ViewChild } from '@angular/core';
import { Nav, Platform } from 'ionic-angular';
import { StatusBar, Splashscreen } from 'ionic-native';
import { HttpModule } from '@angular/http';
import { Camera } from '@ionic-native/camera';

import { ReceiptPoster } from './../shared/receipt-post.service';
import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'
import { ActionSheetController } from 'ionic-angular';

// Pages Import 
// Page1 and Page2 are test and placeholder pages.

import { HomePage } from './../pages/home/home';
import { LoginPage } from './../pages/login/login';
import { UserSettingsPage } from './../pages/user-settings/user-settings';
import { HelpPage } from './../pages/help/help';
import { TaxInfoPage } from './../pages/tax-info/tax-info';
import { AccountsPage } from './../pages/accounts/accounts';
import { AboutPage } from './../pages/about/about';
import { ReportsPage } from './../pages/reports/reports';
import { AddReceiptPage } from './../pages/add-receipt/add-receipt';
// import { Page1 } from '../pages/page1/page1';
// import { Page2 } from '../pages/page2/page2';
import { MyVaultPage } from './../pages/my-vault/my-vault';
import { YelpResultPage } from './../pages/yelp-result/yelp-result';
import { ReceiptFormPage } from './../pages/receipt-form/receipt-form';
import { ProductDetail } from './../pages/product-detail/product-detail';

// API Imports
import { UserApi } from '../pages/shared/shared';

@Component({
  templateUrl: 'app.html',
  providers: [
    UserApi,
    HttpModule
  ]
})
export class MyApp {
  @ViewChild(Nav) nav: Nav;

  // It would probably be smarter to use HomePage as root,
  // Attempting to Change it back to homepage to fix navigation, will look into,
  // using overlay for Login.
  rootPage: any = HomePage;

  pages: Array<{title: string, component: any}>;

  constructor(public platform: Platform, public camera: Camera) {
    this.initializeApp();

    // used for an example of ngFor and navigation
    // we should add the logout as a function to the navbar
    this.pages = [
      { title: 'Reports', component: ReportsPage},
      { title: 'Tax Info', component: TaxInfoPage },
      { title: 'Help', component: HelpPage },
      { title: 'About', component: AboutPage },
      { title: 'Settings', component: UserSettingsPage }, ];

  }

  initializeApp() {
    this.platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      StatusBar.styleDefault();
      Splashscreen.hide();

    });
  }
  // commented out, we wont need it since, manually adjusting the navbar
  /*
  openPage(page) {
    // Reset the content nav to have just this page
    // we wouldn't want the back button to show in this scenario
    this.nav.setRoot(page.component);
  }
  */

  goHome() {
    this.nav.popToRoot();
  }

  goToReports() {
    this.nav.push(ReportsPage);
  }

  goToTaxInfo() {
    this.nav.push(TaxInfoPage);
  }

  goToHelp() {
    this.nav.push(HelpPage);
  }
  /*
  goToUserSettings() {
    this.nav.push(UserSettingsPage);
  }
  */
  signOut(){
    this.nav.push(LoginPage)
  }

} // end myapp