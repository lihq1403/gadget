<?php

interface RenderableInterface
{
    public function renderData(): string;
}

class WebService implements RenderableInterface
{
    private string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function renderData(): string
    {
        return $this->data;
    }
}

abstract class RendererDecorator implements RenderableInterface
{
    protected RenderableInterface $wrapped;

    public function __construct(RenderableInterface $render)
    {
        $this->wrapped = $render;
    }
}

class SerializeRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return serialize($this->wrapped->renderData());
    }
}

class JsonRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return json_encode($this->wrapped->renderData());
    }
}

$service = new WebService('foo');

$serializeRenderer = new SerializeRenderer($service);
echo $serializeRenderer->renderData();

echo PHP_EOL;

$jsonRenderer = new JsonRenderer($service);
echo $jsonRenderer->renderData();