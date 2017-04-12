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

  public priceComparisonJson: any;
  public storeComparisonJson: any
  public productToGetDetails: any;
  public compareArray: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}

  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductDetailPage');
    console.log(this.userApi.drugToGetDetails);
    this.productToGetDetails = this.userApi.drugToGetDetails;
    this.loadPrices();
    this.loadStores();
  }

  loadPrices(){
    this.userApi.getProductPrices().subscribe(
      result => {
        this.priceComparisonJson=result.data.price_detail.price;
        console.log("Success : "+this.priceComparisonJson);
      },
      err =>{
        console.error("Error : "+err);
      } ,
      () => {
        console.log('getData completed');
      }
    );
  }

  loadStores(){
    this.userApi.getProductPrices().subscribe(
      result => {
        this.storeComparisonJson=result.data.price_detail.pharmacy;
        console.log("Success : "+this.storeComparisonJson);
      },
      err =>{
        console.error("Error : "+err);
      } ,
      () => {
        console.log('getData completed');
      }
    );
  }

  loadArray(){
    
  }

}
