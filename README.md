Projekt wtyczki do ograczania dostępu do stron wybranym rolom użytkowników

Założenia:
- administrator zaznacza role, dla których chce ograniczyć dostęp do wybranej strony
- po przesłaniu formularza poszczególne role zostają zapisane w tabeli "postmeta" przy danej stronie
- pobierane są wyłącznie role i strony stworzone w innych narzędziach panelu WordPressa. Nie ma możliwości dodawania własnych.
- w momencie, gdy użytkownik wchodzi na daną stronę, wtyczka sprawdza jego rolę oraz zgodę marketingową(dane z tabeli usermeta)
  i porównuje z danymi w 'postmeta' strony. Jeśli nie ma roli ani zgody, zwraca komunikat "nie masz dostępu do tej strony"
- przy sprawdzaniu roli zostanie najpewniej wykorzystany filtr apply_filters( 'the_content', string $content ), który pozwala na wykonanie
  dowolnej funkcji w momencie ładowania contentu strony. Ale to jest jeszcze do przedyskutowania
