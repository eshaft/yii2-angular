import { Component, OnInit } from '@angular/core';
import {Subject} from "rxjs/Subject";
import {LoginService} from "../login/login.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-request-password-reset',
  templateUrl: './request-password-reset.component.html',
  styleUrls: ['./request-password-reset.component.css']
})
export class RequestPasswordResetComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
