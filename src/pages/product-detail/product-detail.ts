import { merge } from 'rxjs/operator/merge';
import { ProductsPage } from './../products/products';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserApi } from './../shared/user-api.service';

@Component({
  selector: 'page-product-detail',
  templateUrl: 'product-detail.html'
})
export class ProductDetail {

  public prices: any;
  public stores: any;
  public drug: any;
  public success: any;
  public productToGetDetails: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductDetailPage');
    this.productToGetDetails = this.userApi.drugToGetDetails;
    this.loadJsonFiles();
  }
  
  loadJsonFiles(){
    this.userApi.getProductPrices().subscribe(
      result => {
        if (result.success === true) {
          this.drug=result;
          this.prices=result.data.price_detail.price;
          this.stores=result.data.price_detail.pharmacy;
          this.success=true;
          console.log("Success Status: ", this.success);
        } else {
          this.success=false;
          console.log("Success Status: ", this.success);
        }

      },

      err => { console.error("Error : "+err);} ,
      () => { console.log('Price Data: ', this.prices, 'Store Data: ', this.stores, 'Drug Data: ', this.drug);} ,
    
    );
  }
  
  goBack() {
    this.navCtrl.pop();
  }
}
