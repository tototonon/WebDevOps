<?php


namespace TononT\Webentwicklung\Http;


class RestRequest extends Request implements IRestAware
{
    /**
     * @var array
     */
    protected array $identifiers;

    /**
     * @param IRequest $request
     * @return RestRequest
     */
    public static function fromRequestInstance(IRequest $request): RestRequest
    {
        $instance = new static();
        $instance->url = $request->getUrl();
        $instance->method = $request->getMethod();
        $instance->parameters = $request->getParameters();
        return $instance;
    }

    /**
     * @return array
     */
    public function getIdentifiers(): array
    {
        return $this->identifiers;
    }

    /**
     * @param array $identifiers
     */
    public function setIdentifiers(array $identifiers): void
    {
        $this->identifiers = $identifiers;
    }

}