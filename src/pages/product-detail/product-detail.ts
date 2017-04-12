import { merge } from 'rxjs/operator/merge';
import { ProductsPage } from './../products/products';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserApi } from './../shared/user-api.service';

/*
  Generated class for the ProductDetail page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-product-detail',
  templateUrl: 'product-detail.html'
})
export class ProductDetail {

  public prices: any;
  public stores: any;
  public fullData: any;
  public productToGetDetails: any;
  public combinedArray: any;
  public index: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductDetailPage');
    this.productToGetDetails = this.userApi.drugToGetDetails;
    this.loadJsonFiles();
  }

  loadJsonFiles(){
    this.userApi.getProductPrices().subscribe(
      result => {
        this.fullData=result.data.price_detail;
        this.prices=result.data.price_detail.price;
        this.stores=result.data.price_detail.pharmacy;
        console.log("FullData Success: ", this.fullData.price);
        console.log("Price Success : ", this.prices);
        console.log("Store Success : ", this.stores);
      },
      err =>{
        console.error("Error : "+err);
      } ,
      () => {
        console.log('getData completed');
      }
    );

    this.makeCombinedArray();
  }

  makeCombinedArray(){
    this.combinedArray = JSON.stringify(this.fullData);
    console.log("CombinedArray: ", this.combinedArray)
  }

  goBack() {
    this.navCtrl.pop();
  }
}
