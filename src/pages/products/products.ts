import { AsyncTestCompleter } from '@angular/core/testing/async_test_completer';
import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserApi } from './../shared/user-api.service';
import { ProductDetail } from './../product-detail/product-detail';

/*
  Generated class for the Products page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-products',
  templateUrl: 'products.html'
})
export class ProductsPage {

  public searchJson: any;
  public success: any;
  public searchEmpty: any = true;
  public temp: any = true;

  constructor(public navCtrl: NavController, public navParams: NavParams, public userApi: UserApi) {}


  ionViewDidLoad() {
    console.log('ionViewDidLoad ProductsPage');
    console.log('SearchEmpty Status: ', this.searchEmpty);
  }

  encodeURIModified(str) {
    return encodeURIComponent(str).replace(/[!'()*]/g, function (c) {
        return '%' + c.charCodeAt(0).toString(16);
    });
  }

  // From Stack Overflow: http://stackoverflow.com/questions/41933567/remove-whitespace-in-url-in-angular2
  // Removes white space from input
  public replaceAll(input: string, find: string, replace: string): string {
   return input.replace(new RegExp(find, 'g'), replace);
  }

  getProducts(searchbar){
    var q = searchbar.srcElement.value;
    if (!q) {
      this.searchEmpty = true;
      console.log("SearchEmpty Status: ", this.searchEmpty)
      return;
    } else {
      this.searchEmpty = false;
      // this.userApi.drugToSearch = encodeURIComponent(q);
      // this.userApi.drugToSearch = q.trim();
      // this.userApi.drugToSearch = this.replaceAll(q, ' ', '');
      q = this.replaceAll(q, ' ', '');
      this.userApi.drugToSearch = this.encodeURIModified(q);
      console.log("SearchEmpty Status: ", this.searchEmpty)
      console.log("What was searched: ", this.userApi.drugToSearch)
      this.loadsearch();
    }
  }

  loadsearch(){
    this.userApi.getProductDataPost().subscribe(
      result => {
        if (result.success === true) {
          this.searchJson=result.data.candidates;
          console.log("Returned Drug Data: ", this.searchJson);
          } else {
          this.success=false;
          console.log("Success Status: ", this.success);
        }
      },
      err =>{
        console.error("Error : "+err);
      } ,
    );
  }

  loadProductDetail(product){
    product = this.encodeURIModified(product);
    console.log("Encoded Product Passed: ", product);
    this.userApi.drugToGetDetails = product;
    this.navCtrl.push(ProductDetail);
  }
}
