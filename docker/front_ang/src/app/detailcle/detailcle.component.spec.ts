import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { DetailcleComponent } from './detailcle.component';

describe('DetailcleComponent', () => {
  let component: DetailcleComponent;
  let fixture: ComponentFixture<DetailcleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailcleComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailcleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
