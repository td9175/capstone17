import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import io from 'socket.io-client';
window["io"] = io;

// Page Imports
import { HomePage } from './../pages/home/home';
import { RegisterPage } from './../pages/register/register';
import { UserSettingsPage } from './../pages/user-settings/user-settings';
import { VaultPage } from './../pages/vault/vault';
import { ServicesPage } from './../pages/services/services';
import { ProductsPage } from './../pages/products/products';
import { LoginPage } from './../pages/login/login';
import { HSAPage } from './../pages/hsa/hsa';
import { FSAPage } from './../pages/fsa/fsa';
import { TaxInfoPage } from './../pages/tax-info/tax-info';
import { HelpPage } from './../pages/help/help';
import { ReportsPage } from './../pages/reports/reports';
import { AboutPage } from './../pages/about/about';
import { AccountsPage } from './../pages/accounts/accounts';
import { MyVaultPage } from './../pages/my-vault/my-vault'; 
import { ReceiptFormPage } from './../pages/receipt-form/receipt-form';
import { AccountDetailPage } from './../pages/account-detail/account-detail';
import { ProductDetail } from './../pages/product-detail/product-detail';
import { AddReceiptPage } from './../pages/add-receipt/add-receipt';

// APIs
import { YelpPoster } from './../pages/shared/yelp-api-post.service';
import { User, UserApi, AuthService, UserGlobals } from './../pages/shared/user-api.service';
//import { ReceiptPoster } from './../pages/shared/receipt-post.service';
import { YelpResultPage } from './../pages/yelp-result/yelp-result';


import { MyApp } from './app.component';
import { Page1 } from '../pages/page1/page1';
import { Page2 } from '../pages/page2/page2';

import { Camera } from '@ionic-native/camera';

import { ActionSheet, ActionSheetOptions } from '@ionic-native/action-sheet'
import { ActionSheetController } from 'ionic-angular';
import { NgForm } from '@angular/forms/src/directives';

@NgModule({
  declarations: [
    HomePage,
    RegisterPage,
    MyApp,
    AccountsPage,
    Page1,
    AboutPage,
    ReportsPage,
    HelpPage,
    FSAPage,
    HSAPage,
    LoginPage,
    ProductsPage,
    ServicesPage,
    YelpResultPage,
    TaxInfoPage,
    VaultPage,
    UserSettingsPage,
    Page2,
    MyVaultPage,
    AddReceiptPage,
    ProductDetail,
    AccountDetailPage,
    ReceiptFormPage
  ],
  imports: [
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    RegisterPage,
    AccountsPage,
    Page1,
    AboutPage,
    ReportsPage,
    HelpPage,
    FSAPage,
    HSAPage,
    LoginPage,
    ProductsPage,
    ServicesPage,
    YelpResultPage,
    TaxInfoPage,
    VaultPage,
    UserSettingsPage,
    Page2,
    MyVaultPage,
    AddReceiptPage,
    ProductDetail,
    AccountDetailPage,
    ReceiptFormPage
  ],
  providers: [YelpPoster, {provide: ErrorHandler, useClass: IonicErrorHandler}, Camera, ActionSheet, ActionSheetController, AuthService, User, UserApi, UserGlobals, NgForm]
})
export class AppModule {}
