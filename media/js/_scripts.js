// Javascript Accordion

var ContentHeight = 0;
var TimeToSlide = 500;
var openAccordion = '';
var hash = window.location.hash.substring( 1 );

function runAccordion(index)
{
  var nID = "Accordion" + index + "Content";
  if(openAccordion == nID)
    nID = '';
  
  ContentHeight = document.getElementById("Accordion" + index + "Content"+"_").offsetHeight;
  setTimeout("animate(" + new Date().getTime() + "," + TimeToSlide + ",'"
      + openAccordion + "','" + nID + "')", 33);
  openAccordion = nID;
}
function animate(lastTick, timeLeft, closingId, openingId)
{  
  var curTick = new Date().getTime();
  var elapsedTicks = curTick - lastTick;
  var opening = (openingId == '') ? null : document.getElementById(openingId);
  var closing = (closingId == '') ? null : document.getElementById(closingId);
 
  if(timeLeft <= elapsedTicks)
  {
    if(opening != null)
            opening.style.height = 'auto';
 
    if(closing != null)
    {
      //closing.style.display = 'none';
      closing.style.height = '0px';
    }
    return;
  }
 
  timeLeft -= elapsedTicks;
  var newClosedHeight = Math.round((timeLeft/TimeToSlide) * ContentHeight);

  if(opening != null)
  {
    if(opening.style.display != 'block')
      opening.style.display = 'block';
    opening.style.height = (ContentHeight - newClosedHeight) + 'px';
  }
 
  if(closing != null)
    closing.style.height = newClosedHeight + 'px';

  setTimeout("animate(" + curTick + "," + timeLeft + ",'"
      + closingId + "','" + openingId + "')", 33);
}

if( hash ) {
    var accordItem = $('.AccordionTitle_QualityB li#' + hash);
    if(accordItem) accordItem.next().slideToggle('normal');
  }