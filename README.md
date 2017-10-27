# laravel helpers

Set of often used assistants

## Model URL

```php
use Bavix\Extensions\ModelURL;

class File extends Model
{
    use ModelURL;
    
    protected $route = 'file';
    
    // ...
}
```
