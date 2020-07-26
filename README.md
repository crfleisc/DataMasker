# DataMasker
Masks sensitive fields for XML, JSON, HTML, and Arrays which are input as Strings

## FUNCTIONALITY

- A string parameter is passed to maskSensitiveData() – attached are various samples of possible input data
- maskSensitiveData() receives this data as a string, not an array, JSON or other data formats
- maskSensitiveData() parses the string and masks sensitive data
- Sensitive data is masked (replaced) with an asterisk (*) character
- Number of (*)s match the original number of characters in that sensitive data
 
- Sensitive data includes the fields below:
	- The credit card number
	- The credit card expiry date
	- The credit card CVV value

- New sensitive fields are able to be easily added by adding them to the $sensitive[TYPE] arrays
- Ensure the maskedSample(s) are updated if adding new sensitive fields or else some tests 
    will fail

- maskSensitiveData() returns the parsed string in the same format that it was provided, but with 
  the sensitive data now masked

- A testing suite to verify the functionality of maskSensitiveData() as well as the methods it
  depends on



## LIMITATIONS AND CONCERNS
			
- Being fairly unfamiliar with PHP before this project, I think that the current state of this
   program is a good stopping point for review. I could improve on most of the issues below,
   but perhaps they're not actually issues or else an entirely different approach is better
   suited. I believe it functions as expected, and would now benefit from a more experienced
   eye before I spend too much more time trying to optimize it.

- My biggest concern is that the code is hugely monolithic. Each of the four file types could 
   be classes containing their respective masker, formatter, and perhaps a static validator 
   method. These classes could extend an abstract class containing getMask() and the arrays 
   of sensitive data (so that new sensitive fields need only be updated in one place). 
   Although this would be favouring inheritance over composition, that would be my first
   instinct. I would move the test suite and sample files to their own files also. 
    
- arrayMasker() can currently only mask numerical data. This was the simplest solution I 
   could find that meets the requirements, but would not be terribly difficult to extend.
   A more general approach would look for alphanumerics instead of numerics. I suspect a 
   carriage return would be there to end the masking while loop. Knowing all of
   the potential kinds of data and it's formatting would make this much easier.

- My test technique requires removing all of the space information before comparing.
   The actual output does not have modified spacing and while they appear nearly 
   identical, it might be that some of the spacing becomes syntactically significant
   elsewhere.

- Testing does not account for additional unwanted information being masked. This could be
   done by counting sequences of *'s with preg_match_all(), and comparing to the size of
   the sensitive[type] array which holds the sensitive keywords.

- I am not terribly confident in my knowledge of string encodings. mb_strlen() may
   have been a better choice instead of strlen() for UTF-8?

- The array and URL validators depend on the existance of the first elements of 
   their respective sensitive[url/array] in the input code. If the input should
   ever change as not to include these, the two validators need to be updated.

- I may have been able to avoid having multiple arrays of sensitive words by searching
   for only the unique common denomenators. Although I can see right away that "CardNum"
   would not work for the XML sample. A separate workaround for that one case may be possible,
   but then all new sensitive words that lack unique common denomenators would need a 
   workaround. This sounds much more complicated than having four distinct arrays.

- Adding new sensitive words requires following what looks like strange formatting. For
   example prefixing with "07_" for URL data. It's not particularly pretty, although my
   testing shows it functions as expected.

- The code largely expects valid inputs and there is very little error handling. I was also
   unfamiliar with initializing parameters within the method declaration, so there could be
   room for improvement there.

- And finally, in my Testing Utilities method sameLength(), I return either a number or a
   boolean depending on the input. Is this bad form, or standard PHP practice? I had very 
   little experience with PHP before this project, and dynamically choosing a return type
   sure feels strange to me!
