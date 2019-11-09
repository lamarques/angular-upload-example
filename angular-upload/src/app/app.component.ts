import { Component } from '@angular/core';
import {FileUploader} from 'ng2-file-upload';

const URL = 'http://localhost:8080/upload.php';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'App Works!';

  uploader: FileUploader = new FileUploader({url: URL});

  file: string;

  submit() {
    this.uploader.uploadAll();
    this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) =>  {
      this.file = response;
      alert(this.file);
    };
  }

}
