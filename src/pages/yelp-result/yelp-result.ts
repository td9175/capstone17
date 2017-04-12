import { Component } from '@angular/core';
import { Http, Headers } from '@angular/http';
import { NavController, NavParams } from 'ionic-angular';
import { YelpPoster } from './../shared/yelp-api-post.service';
import { YelpSearchModel } from './../../models/yelpsearch.model';
import { NgForm } from '@angular/forms/src/directives';

@Component({
  selector: 'page-yelp-result',
  templateUrl: 'yelp-result.html'
})
export class YelpResultPage {

  result: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, private yelpPoster: YelpPoster) { 
    this.result = navParams.get('result');

  }

  

  ionViewDidLoad() {
    console.log('ionViewDidLoad YelpResultPage');
  }

}
